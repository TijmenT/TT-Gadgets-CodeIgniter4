




      <section class="about--container">
      <h1 class="about--header">Dashboard</h1>
      <section class="about--textcontainer">
      <?php
        $session = \Config\Services::session();

    echo '<h2>Email: '.$user['email'].'</h2>';
    echo '<h2>Firstname: '.$user['firstname'].'</h2>';
    echo '<h2>Lastname: '.$user['lastname'].'</h2>';
    echo '<h2>Street: '.$user['street'].'</h2>';

?>
      </section>
    </section>
  </section>    