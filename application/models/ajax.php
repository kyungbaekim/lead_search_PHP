                                                                                                          <?php
class Ajax extends CI_Model {
  function get_leads_count() {
    $query = 'SELECT count(id) AS count FROM leads';
    return $this->db->query($query)->row_array();
  }

  function display_leads($start) {
    $query = "SELECT * FROM leads LIMIT $start, 5";
    $leads = $this->db->query($query)->result_array();
    return $leads;
  }

  function search_by_query_count($data) {
    if(!$data){
      $query = 'SELECT count(id) AS count FROM leads';
    }
    else {
      if(!$data['to_date']){
        $query = "SELECT count(id) AS count FROM leads WHERE (first_name LIKE '%{$data['name']}%' OR last_name LIKE '%{$data['name']}%') AND (registered_datetime >= '{$data['from_date']}')";
      }
      else {
        $query = "SELECT count(id) AS count FROM leads WHERE (first_name LIKE '%{$data['name']}%' OR last_name LIKE '%{$data['name']}%') AND (registered_datetime >= '{$data['from_date']}' and registered_datetime <= '{$data['to_date']}')";
      }
    }
    return $this->db->query($query)->row_array();
  }

  function search_by_query($start, $data) {
    if(!$data){
      $query = "SELECT * FROM leads LIMIT $start, 5";
    }
    else {
      if(!$data['to_date']){
        $query = "SELECT * FROM leads WHERE (first_name LIKE '%{$data['name']}%' OR last_name LIKE '%{$data['name']}%') AND (registered_datetime >= '{$data['from_date']}') LIMIT $start, 5";
      }
      else {
        $query = "SELECT * FROM leads WHERE (first_name LIKE '%{$data['name']}%' OR last_name LIKE '%{$data['name']}%') AND (registered_datetime >= '{$data['from_date']}' and registered_datetime <= '{$data['to_date']}') LIMIT $start, 5";
      }
    }
    // var_dump($query);
    // die();
    $leads = $this->db->query($query)->result_array();
    // var_dump($leads);
    // die();
    return $leads;
  }
}
