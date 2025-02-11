DROP DATABASE IF EXISTS bd_tarot;
CREATE DATABASE bd_tarot;
USE bd_tarot;

-- Tabla de Barajas de Tarot
CREATE TABLE barajas_tarot (
    id_baraja INT AUTO_INCREMENT PRIMARY KEY,
    nombre_baraja VARCHAR(100) NOT NULL UNIQUE,
    descripcion TEXT
);

-- Tabla de Usuarios
CREATE TABLE usuarios (
    id_usuarios INT AUTO_INCREMENT PRIMARY KEY,
    nick_usuario VARCHAR(45) NOT NULL UNIQUE,
    pw_usuario VARCHAR(16) NOT NULL,
    correo_usuario VARCHAR(100) NOT NULL UNIQUE,
    nombre_usuario VARCHAR(45) NOT NULL,
    apellido_usuario VARCHAR(45) NOT NULL,
    nacimiento_usuario DATE
);

-- Tabla de Cartas del Tarot
CREATE TABLE cartas_tarot (
    id_cartas INT AUTO_INCREMENT PRIMARY KEY,
    baraja_id INT NOT NULL,
    tipo_carta ENUM('Mayor', 'Menor') NOT NULL,
    numero_carta INT DEFAULT NULL, -- Número solo para Arcanos Mayores
    nombre_carta VARCHAR(45) NOT NULL,
    invertida BOOLEAN NOT NULL DEFAULT 0, -- 0 = Derecha, 1 = Invertida
    palabras_clave_carta VARCHAR(100),
    foto_carta LONGBLOB,
    FOREIGN KEY (baraja_id) REFERENCES barajas_tarot(id_baraja) ON DELETE CASCADE
);

-- Tabla de Tipos de Tirada
CREATE TABLE tipo_tirada (
    id_tipo_tirada INT AUTO_INCREMENT PRIMARY KEY,
    nombre_tirada VARCHAR(45) NOT NULL,
    descripcion_tirada VARCHAR(255)
);

-- Tabla de Tiradas

CREATE TABLE tiradas (
    id_tirada INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT,
    fecha_tirada TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    resultado VARCHAR(255),
    numero_carta VARCHAR(50),  -- Campo para el número o nombre de la carta
    tipo_arcano ENUM('Mayor', 'Menor') NOT NULL,  -- Indica si es Arcano Mayor o Menor
    posicion_carta ENUM('Derecha', 'Invertida') NOT NULL,  -- Indica si está del derecho o invertida
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario)
);

-- Tabla Relacional: Tiradas - Cartas del Tarot (Muchos a Muchos)
CREATE TABLE tiradas_cartas (
    cartas_tarot_id_cartas INT,
    tiradas_id_tiradas INT,
    tiradas_cartascol VARCHAR(45),
    PRIMARY KEY (cartas_tarot_id_cartas, tiradas_id_tiradas),
    FOREIGN KEY (cartas_tarot_id_cartas) REFERENCES cartas_tarot(id_cartas) ON DELETE CASCADE,
    FOREIGN KEY (tiradas_id_tiradas) REFERENCES tiradas(id_tiradas) ON DELETE CASCADE
);

INSERT INTO barajas_tarot (nombre_baraja) VALUES ("Tarot de Marsella"); --no le indicamos un id ya que este esta indicado como autoincremental, se generará automaticamente un

-- Arcanos Mayores (22 cartas en posición normal e invertida)
--El atributo invertida es un booleano que indica la posicion 0-Derecha 1-Invertida
INSERT INTO cartas_tarot (baraja_id, tipo_carta, numero_carta, nombre_carta, invertida, palabras_clave_carta) VALUES
(1, 'Mayor', 0, 'El Loco', 0, 'Libertad, espontaneidad, locura, nuevas aventuras'),
(1, 'Mayor', 0, 'El Loco', 1, 'Imprudencia, inmadurez, irresponsabilidad, caos'),

(1, 'Mayor', 1, 'El Mago', 0, 'Habilidad, creatividad, poder, manifestación'),
(1, 'Mayor', 1, 'El Mago', 1, 'Manipulación, engaño, falta de confianza, trucos'),

(1, 'Mayor', 2, 'La Papisa', 0, 'Sabiduría, intuición, misterio, conocimiento oculto'),
(1, 'Mayor', 2, 'La Papisa', 1, 'Secretos revelados, superficialidad, desconexión'),

(1, 'Mayor', 3, 'La Emperatriz', 0, 'Fertilidad, abundancia, creatividad, protección'),
(1, 'Mayor', 3, 'La Emperatriz', 1, 'Dependencia, estancamiento, infertilidad'),

(1, 'Mayor', 4, 'El Emperador', 0, 'Autoridad, estructura, liderazgo, disciplina'),
(1, 'Mayor', 4, 'El Emperador', 1, 'Tiranía, rigidez, falta de control, debilidad'),

(1, 'Mayor', 5, 'El Papa', 0, 'Guía espiritual, enseñanza, tradición, moralidad'),
(1, 'Mayor', 5, 'El Papa', 1, 'Dogmatismo, rebelión, falsedad espiritual'),

(1, 'Mayor', 6, 'Los Enamorados', 0, 'Amor, elección, relaciones, dualidad'),
(1, 'Mayor', 6, 'Los Enamorados', 1, 'Desarmonía, conflicto, decisiones difíciles'),

(1, 'Mayor', 7, 'El Carro', 0, 'Victoria, control, determinación, dirección'),
(1, 'Mayor', 7, 'El Carro', 1, 'Pérdida de control, agresividad, fracaso'),

(1, 'Mayor', 8, 'La Justicia', 0, 'Equilibrio, verdad, responsabilidad, decisión'),
(1, 'Mayor', 8, 'La Justicia', 1, 'Injusticia, falta de honestidad, corrupción'),

(1, 'Mayor', 9, 'El Ermitaño', 0, 'Búsqueda interior, reflexión, soledad, iluminación'),
(1, 'Mayor', 9, 'El Ermitaño', 1, 'Soledad extrema, aislamiento, desorientación'),

(1, 'Mayor', 10, 'La Rueda de la Fortuna', 0, 'Destino, ciclos, cambios, suerte'),
(1, 'Mayor', 10, 'La Rueda de la Fortuna', 1, 'Mala suerte, estancamiento, falta de control'),

(1, 'Mayor', 11, 'La Fuerza', 0, 'Coraje, dominio de uno mismo, paciencia, resistencia'),
(1, 'Mayor', 11, 'La Fuerza', 1, 'Debilidad, miedo, falta de autocontrol'),

(1, 'Mayor', 12, 'El Colgado', 0, 'Sacrificio, nueva perspectiva, espera, entrega'),
(1, 'Mayor', 12, 'El Colgado', 1, 'Egoísmo, resistencia al cambio, estancamiento'),

(1, 'Mayor', 13, 'La Muerte', 0, 'Transformación, cambio, renacimiento, finales'),
(1, 'Mayor', 13, 'La Muerte', 1, 'Resistencia al cambio, miedo, estancamiento'),

(1, 'Mayor', 14, 'La Templanza', 0, 'Equilibrio, armonía, paciencia, sanación'),
(1, 'Mayor', 14, 'La Templanza', 1, 'Desequilibrio, impaciencia, excesos'),

(1, 'Mayor', 15, 'El Diablo', 0, 'Tentación, materialismo, ataduras, obsesión'),
(1, 'Mayor', 15, 'El Diablo', 1, 'Liberación, superación de miedos, independencia'),

(1, 'Mayor', 16, 'La Torre', 0, 'Colapso, crisis, revelación, despertar'),
(1, 'Mayor', 16, 'La Torre', 1, 'Evitar el cambio, miedo a lo inevitable'),

(1, 'Mayor', 17, 'La Estrella', 0, 'Esperanza, inspiración, renovación, espiritualidad'),
(1, 'Mayor', 17, 'La Estrella', 1, 'Pérdida de fe, desesperanza, ilusiones rotas');

-- Arcanos Menores: Copas
-- Palos: Copas (14 cartas)

-- Copas 1-10
INSERT INTO cartas_tarot (baraja_id, tipo_carta, numero_carta, nombre_carta, invertida, palabras_clave_carta) VALUES
(1, 'Menor', 1, 'As de Copas', 0, 'Amor, felicidad, abundancia emocional, nuevos comienzos'),
(1, 'Menor', 1, 'As de Copas', 1, 'Emociones bloqueadas, falta de amor, desconexión emocional'),

(1, 'Menor', 2, 'Dos de Copas', 0, 'Unión, relación, armonía, conexión emocional'),
(1, 'Menor', 2, 'Dos de Copas', 1, 'Desacuerdo, separación, conflicto emocional'),

(1, 'Menor', 3, 'Tres de Copas', 0, 'Celebración, amistad, alegría, colaboración'),
(1, 'Menor', 3, 'Tres de Copas', 1, 'Desunión, traición, malentendidos'),

(1, 'Menor', 4, 'Cuatro de Copas', 0, 'Reflexión, introspección, desconexión emocional'),
(1, 'Menor', 4, 'Cuatro de Copas', 1, 'Aburrimiento, insatisfacción, rechazo de oportunidades'),

(1, 'Menor', 5, 'Cinco de Copas', 0, 'Pérdida, tristeza, arrepentimiento, aceptación'),
(1, 'Menor', 5, 'Cinco de Copas', 1, 'Negación, depresión, obsesión por el pasado'),

(1, 'Menor', 6, 'Seis de Copas', 0, 'Recuerdos, nostalgia, inocencia, simplicidad'),
(1, 'Menor', 6, 'Seis de Copas', 1, 'Estancamiento, vivir en el pasado, no dejar ir'),

(1, 'Menor', 7, 'Siete de Copas', 0, 'Opciones, fantasía, ilusión, elecciones'),
(1, 'Menor', 7, 'Siete de Copas', 1, 'Confusión, desilusión, falta de claridad'),

(1, 'Menor', 8, 'Ocho de Copas', 0, 'Renuncia, dejar ir, búsqueda de algo más'),
(1, 'Menor', 8, 'Ocho de Copas', 1, 'Evasión, negarse a enfrentar la realidad'),

(1, 'Menor', 9, 'Nueve de Copas', 0, 'Satisfacción, alegría, éxito emocional, deseos cumplidos'),
(1, 'Menor', 9, 'Nueve de Copas', 1, 'Desilusión, vacuidad, insatisfacción'),

(1, 'Menor', 10, 'Diez de Copas', 0, 'Felicidad familiar, armonía, plenitud emocional'),
(1, 'Menor', 10, 'Diez de Copas', 1, 'Desconexión familiar, conflictos emocionales'),

-- Cartas de la corte: Copas
(1, 'Menor', NULL, 'Paje de Copas', 0, 'Curiosidad emocional, nuevos comienzos, mensaje de amor'),
(1, 'Menor', NULL, 'Paje de Copas', 1, 'Inmadurez emocional, ilusiones, falta de compromiso'),

(1, 'Menor', NULL, 'Caballero de Copas', 0, 'Idealismo, romanticismo, búsqueda de amor'),
(1, 'Menor', NULL, 'Caballero de Copas', 1, 'Desilusión, irresponsabilidad, evasión emocional'),

(1, 'Menor', NULL, 'Reina de Copas', 0, 'Empatía, cuidado, intuición, comprensión emocional'),
(1, 'Menor', NULL, 'Reina de Copas', 1, 'Emocionalmente distante, manipulación, inestabilidad emocional'),

(1, 'Menor', NULL, 'Rey de Copas', 0, 'Dominio emocional, equilibrio, sabiduría emocional'),
(1, 'Menor', NULL, 'Rey de Copas', 1, 'Falta de control emocional, manipulación, frialdad'),

-- Arcanos Menores: Bastos

INSERT INTO cartas_tarot (baraja_id, tipo_carta, numero_carta, nombre_carta, invertida, palabras_clave_carta) VALUES
(1, 'Menor', 1, 'As de Bastos', 0, 'Energía, pasión, nuevos comienzos, inspiración'),
(1, 'Menor', 1, 'As de Bastos', 1, 'Bloqueo creativo, falta de dirección, retrasos'),

(1, 'Menor', 2, 'Dos de Bastos', 0, 'Planificación, visión, avance hacia el futuro'),
(1, 'Menor', 2, 'Dos de Bastos', 1, 'Falta de planificación, miedo al cambio, estancamiento'),

(1, 'Menor', 3, 'Tres de Bastos', 0, 'Expansión, crecimiento, cooperación, oportunidades'),
(1, 'Menor', 3, 'Tres de Bastos', 1, 'Decepción, falta de acción, obstáculos'),

(1, 'Menor', 4, 'Cuatro de Bastos', 0, 'Estabilidad, celebración, logros, armonía'),
(1, 'Menor', 4, 'Cuatro de Bastos', 1, 'Conflictos, inestabilidad, falta de reconocimiento'),

(1, 'Menor', 5, 'Cinco de Bastos', 0, 'Competencia, conflicto, lucha, desafío'),
(1, 'Menor', 5, 'Cinco de Bastos', 1, 'Desorganización, enfrentamientos, falta de progreso'),

(1, 'Menor', 6, 'Seis de Bastos', 0, 'Éxito, reconocimiento, victoria, logros'),
(1, 'Menor', 6, 'Seis de Bastos', 1, 'Fracaso, falta de éxito, pérdida de reconocimiento'),

(1, 'Menor', 7, 'Siete de Bastos', 0, 'Defensa, perseverancia, desafíos, mantener el control'),
(1, 'Menor', 7, 'Siete de Bastos', 1, 'Rendirse, abandonar, perder la posición'),

(1, 'Menor', 8, 'Ocho de Bastos', 0, 'Movimiento rápido, comunicación, progreso, acción'),
(1, 'Menor', 8, 'Ocho de Bastos', 1, 'Retrasos, falta de movimiento, bloqueos de comunicación'),

(1, 'Menor', 9, 'Nueve de Bastos', 0, 'Resistencia, determinación, lucha, perseverancia'),
(1, 'Menor', 9, 'Nueve de Bastos', 1, 'Agotamiento, rendirse, debilidad'),

(1, 'Menor', 10, 'Diez de Bastos', 0, 'Carga, responsabilidad, agotamiento, presión'),
(1, 'Menor', 10, 'Diez de Bastos', 1, 'Liberación de cargas, dejar ir, aligerar el peso'),

-- Cartas de la corte: Bastos
(1, 'Menor', NULL, 'Paje de Bastos', 0, 'Curiosidad, entusiasmo, nuevos comienzos, exploración'),
(1, 'Menor', NULL, 'Paje de Bastos', 1, 'Impulsividad, falta de dirección, inmadurez'),

(1, 'Menor', NULL, 'Caballero de Bastos', 0, 'Acción, valentía, impulso, aventura'),
(1, 'Menor', NULL, 'Caballero de Bastos', 1, 'Irresponsabilidad, imprudencia, falta de dirección'),

(1, 'Menor', NULL, 'Reina de Bastos', 0, 'Confianza, pasión, independencia, carisma'),
(1, 'Menor', NULL, 'Reina de Bastos', 1, 'Inseguridad, falta de motivación, intimidación'),

(1, 'Menor', NULL, 'Rey de Bastos', 0, 'Liderazgo, visión, acción, toma de decisiones'),
(1, 'Menor', NULL, 'Rey de Bastos', 1, 'Falta de control, imprudencia, liderazgo tóxico'),

-- Espadas 1-10
INSERT INTO cartas_tarot (baraja_id, tipo_carta, numero_carta, nombre_carta, invertida, palabras_clave_carta) VALUES
(1, 'Menor', 1, 'As de Espadas', 0, 'Verdad, claridad, nuevos comienzos, victoria intelectual'),
(1, 'Menor', 1, 'As de Espadas', 1, 'Confusión, falta de claridad, errores de juicio'),

(1, 'Menor', 2, 'Dos de Espadas', 0, 'Conflicto, decisión difícil, bloqueo emocional'),
(1, 'Menor', 2, 'Dos de Espadas', 1, 'Indecisión, evasión, evitar confrontación'),

(1, 'Menor', 3, 'Tres de Espadas', 0, 'Dolor, traición, sufrimiento, desamor'),
(1, 'Menor', 3, 'Tres de Espadas', 1, 'Superación del dolor, liberación, sanación'),

(1, 'Menor', 4, 'Cuatro de Espadas', 0, 'Descanso, recuperación, meditación, reflexión'),
(1, 'Menor', 4, 'Cuatro de Espadas', 1, 'Procrastinación, incapacidad para descansar, agotamiento'),

(1, 'Menor', 5, 'Cinco de Espadas', 0, 'Conflicto, derrota, traición, pérdida'),
(1, 'Menor', 5, 'Cinco de Espadas', 1, 'Reconocimiento de la derrota, aprendizaje, reconciliación'),

(1, 'Menor', 6, 'Seis de Espadas', 0, 'Cambio, transición, movimiento hacia lo mejor'),
(1, 'Menor', 6, 'Seis de Espadas', 1, 'Dificultad para dejar el pasado, resistencia al cambio'),

(1, 'Menor', 7, 'Siete de Espadas', 0, 'Engaño, evasión, estrategia, discreción'),
(1, 'Menor', 7, 'Siete de Espadas', 1, 'Deshonestidad, falsedad, ocultación'),

(1, 'Menor', 8, 'Ocho de Espadas', 0, 'Limitaciones, opresión, sentirse atrapado'),
(1, 'Menor', 8, 'Ocho de Espadas', 1, 'Liberación, superación de obstáculos, claridad'),

(1, 'Menor', 9, 'Nueve de Espadas', 0, 'Ansiedad, preocupación, insomnio, miedo'),
(1, 'Menor', 9, 'Nueve de Espadas', 1, 'Alivio, superación del miedo, calma mental'),

(1, 'Menor', 10, 'Diez de Espadas', 0, 'Ruina, traición, dolor, final de ciclo'),
(1, 'Menor', 10, 'Diez de Espadas', 1, 'Renacimiento, liberación de la angustia, nuevo comienzo'),

-- Cartas de la corte: Espadas
(1, 'Menor', NULL, 'Paje de Espadas', 0, 'Curiosidad intelectual, vigilancia, observación'),
(1, 'Menor', NULL, 'Paje de Espadas', 1, 'Chismes, falta de comunicación clara, engaños'),

(1, 'Menor', NULL, 'Caballero de Espadas', 0, 'Acción, decisión, velocidad, audacia'),
(1, 'Menor', NULL, 'Caballero de Espadas', 1, 'Impulsividad, agresividad, conflicto'),

(1, 'Menor', NULL, 'Reina de Espadas', 0, 'Inteligencia, independencia, objetividad, claridad'),
(1, 'Menor', NULL, 'Reina de Espadas', 1, 'Frialdad, rigidez, crítica excesiva'),

(1, 'Menor', NULL, 'Rey de Espadas', 0, 'Autoridad, lógica, justicia, decisión'),
(1, 'Menor', NULL, 'Rey de Espadas', 1, 'Manipulación, abuso de poder, falta de empatía'),


-- Oros 1-10
INSERT INTO cartas_tarot (baraja_id, tipo_carta, numero_carta, nombre_carta, invertida, palabras_clave_carta) VALUES
(1, 'Menor', 1, 'As de Oros', 0, 'Prosperidad, oportunidades, nuevos comienzos, estabilidad financiera'),
(1, 'Menor', 1, 'As de Oros', 1, 'Falta de oportunidades, mala suerte, inestabilidad financiera'),

(1, 'Menor', 2, 'Dos de Oros', 0, 'Equilibrio, flexibilidad, adaptación, cambios financieros'),
(1, 'Menor', 2, 'Dos de Oros', 1, 'Desorganización, inestabilidad, falta de prioridades'),

(1, 'Menor', 3, 'Tres de Oros', 0, 'Trabajo en equipo, colaboración, habilidades, logros'),
(1, 'Menor', 3, 'Tres de Oros', 1, 'Falta de cooperación, trabajo insuficiente, desorganización'),

(1, 'Menor', 4, 'Cuatro de Oros', 0, 'Seguridad financiera, control, estabilidad material'),
(1, 'Menor', 4, 'Cuatro de Oros', 1, 'Apego, avaricia, miedo a la pérdida'),

(1, 'Menor', 5, 'Cinco de Oros', 0, 'Pérdida, dificultad económica, crisis'),
(1, 'Menor', 5, 'Cinco de Oros', 1, 'Recuperación, apoyo, superación de dificultades'),

(1, 'Menor', 6, 'Seis de Oros', 0, 'Generosidad, equilibrio, dar y recibir, abundancia'),
(1, 'Menor', 6, 'Seis de Oros', 1, 'Desigualdad, falta de reciprocidad, abuso de poder'),

(1, 'Menor', 7, 'Siete de Oros', 0, 'Paciencia, espera, reflexión sobre el trabajo realizado'),
(1, 'Menor', 7, 'Siete de Oros', 1, 'Frustración, falta de resultados, impaciencia'),

(1, 'Menor', 8, 'Ocho de Oros', 0, 'Trabajo duro, dedicación, aprendizaje, maestría'),
(1, 'Menor', 8, 'Ocho de Oros', 1, 'Falta de habilidad, desinterés, no apreciar el esfuerzo'),

(1, 'Menor', 9, 'Nueve de Oros', 0, 'Independencia, éxito material, satisfacción, logros personales'),
(1, 'Menor', 9, 'Nueve de Oros', 1, 'Insatisfacción, avaricia, desconfianza'),

(1, 'Menor', 10, 'Diez de Oros', 0, 'Familia, legado, seguridad financiera, estabilidad a largo plazo'),
(1, 'Menor', 10, 'Diez de Oros', 1, 'Pérdida de herencia, ruptura familiar, inestabilidad'),

-- Cartas de la corte: Oros
(1, 'Menor', NULL, 'Paje de Oros', 0, 'Estudio, enfoque, nuevos comienzos financieros, aprendizaje'),
(1, 'Menor', NULL, 'Paje de Oros', 1, 'Falta de enfoque, inmadurez financiera, oportunidades perdidas'),

(1, 'Menor', NULL, 'Caballero de Oros', 0, 'Responsabilidad, trabajo duro, fiabilidad, paciencia'),
(1, 'Menor', NULL, 'Caballero de Oros', 1, 'Lentitud, estancamiento, falta de progreso'),

(1, 'Menor', NULL, 'Reina de Oros', 0, 'Abundancia, cuidado, estabilidad financiera, fertilidad'),
(1, 'Menor', NULL, 'Reina de Oros', 1, 'Desorden, falta de control, enfoque materialista'),

(1, 'Menor', NULL, 'Rey de Oros', 0, 'Riqueza, estabilidad, éxito, visión material'),
(1, 'Menor', NULL, 'Rey de Oros', 1, 'Codicia, abuso de poder, falta de compasión'),
