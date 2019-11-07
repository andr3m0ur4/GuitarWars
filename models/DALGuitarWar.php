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

	public function getTotal ( $query )
	{

		$result = $this -> con -> query ( $query );

		$total = $result -> num_rows;

		return $total;

	}
	
	// Este método cria uma consulta de busca a partir das palavras-chave da busca e configuração 
	// de classificação
	public function build_query ( $user_search, $sort )
	{

	    $search_query = "SELECT * FROM riskyjobs";

	    // Extrair as palavras-chave da busca em um vetor
	    $clean_search = str_replace ( ',', ' ', $user_search );
	    $search_words = explode ( ' ', $clean_search );

	    $final_search_words = array ( );

	    if ( count ( $search_words ) > 0 ) {
	        foreach ( $search_words as $word ) {
	            if ( !empty ( $word ) ) {
	                $final_search_words[] = $word;
	            }
	        }
	    }

	    // Gera uma cláusula WHERE utilizando todas as plavras-chave da busca
	    $where_list = array ( );

	    if ( count ( $final_search_words ) > 0 ) {
	        foreach ( $final_search_words as $word ) {
	            $where_list[] = "description LIKE '%$word%'";
	        }
	    }

	    $where_clause = implode ( ' OR ', $where_list );

	    // Adiciona a palavra-chave da cláusula WHERE à consulta de busca
	    if ( !empty ( $where_clause ) ) {
	        $search_query .= " WHERE $where_clause";
	    }

	    // Classifica a consulta de busca utilizando a configuração de classificação
	    switch ( $sort ) {

	        // Ascendente por título de trabalho
	        case 1:
	            $search_query .= " ORDER BY title";
	            break;

	        // Decrescente por título de trabalho
	        case 2:
	            $search_query .= " ORDER BY title DESC";
	            break;

	        // Ascendente por estado
	        case 3:
	            $search_query .= " ORDER BY state";
	            break;

	        // Decrescente por estado
	        case 4:
	            $search_query .= " ORDER BY state DESC";
	            break;

	        // Ascendente pela data postada (mais velho primeiro)
	        case 5:
	            $search_query .= " ORDER BY date_posted";
	            break;

	        // Decrescente pela data postada (mais novo primeiro)
	        case 6:
	            $search_query .= " ORDER BY date_posted DESC";
	            break;

	        // Nenhuma configuração de classificação fornecida, portanto, não classificar a consulta    
	        default:
	      
	    }

	    return $search_query;

	}

	public function __destruct ( )
	{

		$this -> con -> close ( );

	}
}
