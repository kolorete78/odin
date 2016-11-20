<?php
class Altafinal_model extends CI_Model
{

    public function __construct()
    {
        $this->load->database();

    }

    function get_materias(){

        // armamos la consulta
        // Alumnos que hayan aprobado 1 y 2 parcial (o recuperatorio
        // que haya aprobado el tp
        // que no esten inscriptos en esa materia


        //$query= $this->db->query("
        //SELECT materia_id, materia_nombre FROM materia WHERE materia_id IN
        //(SELECT materia_id FROM materia_alumno WHERE
         // alumno_id in (SELECT alumno_id FROM alumno WHERE alumno_dni= {$_SESSION['username']})
        //AND  (materia_alumno.tp like 'Aprobado')
        //AND (1Parcial >= 4 OR 1Recu >= 4 )
        //AND (2Parcial >= 4 OR 2Recu >= 4)
        //AND (materia_id IN
          //      (SELECT final_mat_id from fechafinales WHERE final_id
          //      IN (SELECT inscfinal_final_id FROM inscripcionfinales WHERE
          //      insfinal_alumno_id IN (SELECT alumno_id FROM alumno WHERE alumno_dni={$_SESSION['username']})
          //      AND inscripcionfinales.inscfinal_alumno_ausente = TRUE ))))");

        $query=$this->db->query("SELECT materia.materia_id, materia.materia_nombre from materia
WHERE materia.materia_id IN (SELECT materia_id FROM materia_alumno WHERE alumno_id IN
        (SELECT alumno_id FROM alumno WHERE alumno_dni= {$_SESSION['username']})
AND (materia_alumno.tp = 'Aprobado' OR materia_alumno.tp ='Equivalencia')
AND (1Parcial >= 4 OR 1Parcial = 'E' OR 1Recu >= 4)
AND (2Parcial >= 4 OR 1Parcial = 'E' OR 2Recu >= 4)
AND (Final < 4)
AND (materia.materia_id NOT IN
        (SELECT final_mat_id FROM fechafinales
       WHERE final_id IN (SELECT inscfinal_final_id FROM inscripcionfinales
         WHERE (insfinal_alumno_id = (SELECT alumno_id FROM alumno WHERE alumno_dni= {$_SESSION['username']}) AND
         inscripcionfinales.inscfinal_alumno_ausente = 'TRUE'
               )))))");




        // si hay resultados
	$affectedrows = $this->db->affected_rows();
        if ($affectedrows > 0 ) {
            // almacenamos en una matriz bidimensional
            //$arrDatos[htmlspecialchars('0')]=htmlspecialchars('Seleccionar');
            $arrDatos[0]='Seleccionar';
            foreach($query->result() as $row)
                $arrDatos[htmlspecialchars($row->materia_id, ENT_QUOTES)] =
                    htmlspecialchars($row->materia_nombre, ENT_QUOTES);

            $query->free_result();

            return $arrDatos;
        }
    }

    public function get_fechas($final_mat_id)
    {
        //armamos la consulta para traer las fechas de la comision del alumno y que este activo el final
        $query = $this->db->query(
            "SELECT  final_id ,  final_fecha  FROM fechafinales WHERE
            final_mat_id =" .$final_mat_id ."
            AND final_activa = TRUE
            AND final_comision LIKE (SELECT comision FROM alumno WHERE alumno_dni={$_SESSION['username']})");
        return $query->result();

     }
    public function grabar_final($final_mat_id, $fecha)
     {
         $condicion=null;
         if(!empty($_SESSION['id_user']))
         {

             $sql = ("SELECT final_id FROM fechafinales WHERE `final_mat_id`=$final_mat_id AND final_fecha = '$fecha'");

             $query= $this->db->query($sql);
             $row = $query->row();
             if (isset($row))
             {
                 $condicion= $row->final_id;
             }
         }
        if (isset($condicion)){
            $sql=("INSERT INTO `inscripcionfinales`(`inscfinal_final_id`, `insfinal_alumno_id`)
            VALUES ('$condicion','{$_SESSION['id_user']}')");

            $this->db->query($sql);

        }

    }

    public function materia_nombre($materia_id){

        if(!empty($_SESSION['id_user']))
        {

            $sql = ("SELECT materia_nombre FROM materia WHERE `materia_id`='$materia_id'");

            $query= $this->db->query($sql);
            $row = $query->row();
            if (isset($row))
            {
                $condicion= $row->materia_nombre;
            }
        }

        return $condicion;
    }

}
 
