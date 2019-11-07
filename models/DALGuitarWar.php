<?php  

class DALGuitarWar
{

	private $con;

	public function __construct ( mysqli $con )
	{

		$this -> con = $con;

	}

	public function select ( )
	{

		$sql = "SELECT * FROM guitarwars WHERE approved = 1 ORDER BY score DESC, date ASC";

		$result = $this -> con -> query ( $sql );

		$guitars = [];

		while ( $guitar  = $result -> fetch_object ( 'GuitarWar' ) ) {
			$guitars[] = $guitar;
		}

		return $guitars;

	}

	public function selectAll ( )
	{

		$sql = "SELECT * FROM guitarwars ORDER BY score DESC, date ASC";

		$result = $this -> con -> query ( $sql );

		$guitars = [];

		while ( $guitar  = $result -> fetch_object ( 'GuitarWar' ) ) {
			$guitars[] = $guitar;
		}

		return $guitars;

	}

	public function save ( GuitarWar $guitar ) 
	{

		$sql = "
			INSERT INTO guitarwars 
			(
				date, name, score, screenshot
			)
            VALUES 
            (
            	NOW(),
            	'{$guitar -> name}',
            	'{$guitar -> score}',
            	'{$guitar -> screenshot}'
            )
        ";

        $this -> con -> query ( $sql );

        return ( $this -> con -> affected_rows > 0 ) ? true : false;

	}

	public function update ( GuitarWar $guitar )
	{
		$sql = "UPDATE guitarwars SET approved = 1 WHERE id = {$guitar -> id}";

		$this -> con -> query ( $sql );

		return ( $this -> con -> affected_rows > 0 ) ? true : false;
	}

	public function delete ( $id )
	{
		$sql = "DELETE FROM guitarwars WHERE id = $id LIMIT 1";

		$this -> con -> query ( $sql );

		return ( $this -> con -> affected_rows > 0 ) ? true : false;
	}

	public function __destruct ( )
	{

		$this -> con -> close ( );

	}
}
