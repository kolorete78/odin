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

    public function get_profesores()
    {

        //armamos la consulta
        //traemos todas las carreras


        $query = $this->db->query("SELECT profesor_id, profesor_nombre from profesor");

        // si hay resultados
        $affectedrows = $this->db->affected_rows();
        if ($affectedrows > 0) {

            $arrDatos[0] = 'Seleccionar';
            foreach ($query->result() as $row)
                $arrDatos[htmlspecialchars($row->profesor_id, ENT_QUOTES)] =
                    htmlspecialchars($row->profesor_nombre, ENT_QUOTES);

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

    public function materia_codigo($materia_id){

        if(!empty($_SESSION['id_user']))
        {

            $sql = ("SELECT materia_codigo FROM materia WHERE `materia_id`='$materia_id'");

            $query= $this->db->query($sql);
            $row = $query->row();
            if (isset($row))
            {
                $condicion= $row->materia_codigo;
            }
        }

        return $condicion;
    }

    function obtenerListaAlumnos($materia_id, $fecha, $comision)
        {

            //$sql=('SELECT Alumno, DNI FROM Inscriptos WHERE fecha_final_id IN
            //      (SELECT final_id from fechafinales WHERE
            //        final_fecha = "'. $fecha .'"
            //        AND final_comision = "'. $comision . '"
            //        AND final_mat_id = "'. $materia_id .'")');
            $alumnos = $this->db->query('SELECT Alumno, DNI FROM Inscriptos WHERE fecha_final_id IN
                  (SELECT final_id from fechafinales WHERE
                    final_fecha = "'. $fecha .'"
                    AND final_comision = "'. $comision . '"
                    AND final_mat_id = "'. $materia_id .'") ORDER BY Alumno ');
            return $alumnos->result();
        }

}