<?php
class Actavolante_model extends CI_Model
{

    public function __construct()
    {
        $this->load->database();

    }

    function get_materias()
    {

        // armamos la consulta
        //traemos todas las materias


        $query = $this->db->query("SELECT materia.materia_id, materia.materia_nombre from materia");

        // si hay resultados
        $affectedrows = $this->db->affected_rows();
        if ($affectedrows > 0) {
            // almacenamos en una matriz bidimensional
            //$arrDatos[htmlspecialchars('0')]=htmlspecialchars('Seleccionar');
            $arrDatos[0] = 'Seleccionar';
            foreach ($query->result() as $row)
                $arrDatos[htmlspecialchars($row->materia_id, ENT_QUOTES)] =
                    htmlspecialchars($row->materia_nombre, ENT_QUOTES);

            $query->free_result();

            return $arrDatos;
        }
    }

    function get_carrera()
    {

        // armamos la consulta
        //traemos todas las carreras


        $query = $this->db->query("SELECT carrera.carrera_id, carrera.carrera_nombre from carrera");

        // si hay resultados
        $affectedrows = $this->db->affected_rows();
        if ($affectedrows > 0) {

            $arrDatos[0] = 'Seleccionar';
            foreach ($query->result() as $row)
                $arrDatos[htmlspecialchars($row->carrera_id, ENT_QUOTES)] =
                    htmlspecialchars($row->carrera_nombre, ENT_QUOTES);

            $query->free_result();

            return $arrDatos;
        }
    }

    public function get_fechas($final_mat_id)
    {
        //armamos la consulta para traer las fechas del final
        $query = $this->db->query(
            "SELECT  final_id ,  final_fecha  FROM fechafinales WHERE
            final_mat_id =" .$final_mat_id);
        return $query->result();

    }

}