@GetMapping("/grupos/{ies}")
public ArrayList<grupo> grupoDeUnIes (@PathVariable String ies) {
    
    List<Grupo> grupos = new ArrayList<>();
    
    for (Grupo grupo : grupos) {
        if (grupo.getIes().equalsIgnoreCase(ies)) {
            grupos.add(grupo);
        }
    }
    

}
