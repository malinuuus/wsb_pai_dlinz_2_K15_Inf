<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Użytkownicy</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="./logged.php">Home</a></li>
                        <li class="breadcrumb-item active">Użytkownicy</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <div class="card">
        <div class="card-body">
            <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <table id="example1" class="table table-bordered table-striped dataTable dtr-inline"
                               aria-describedby="example1_info">
                            <thead>
                            <tr>
                                <th class="sorting sorting_asc" tabindex="0" aria-controls="example1" rowspan="1"
                                    colspan="1" aria-sort="ascending"
                                    aria-label="Rendering engine: activate to sort column descending">Imię
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                    aria-label="Browser: activate to sort column ascending">Nazwisko
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                    aria-label="Platform(s): activate to sort column ascending">Miasto
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                    aria-label="Engine version: activate to sort column ascending">Data utworzenia
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                    aria-label="CSS grade: activate to sort column ascending">Data ostatniego logowania
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                    aria-label="CSS grade: activate to sort column ascending">Rola
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            require_once "../scripts/connect.php";
                            $result = $conn->query("SELECT u.firstName, u.lastName, c.city, u.created_at, MAX(l.created_at) AS last_log, r.role FROM users u INNER JOIN cities c on u.city_id = c.id INNER JOIN roles r on u.role_id = r.id LEFT JOIN logs l on u.id = l.user_id GROUP BY u.id");

                            while ($user = $result->fetch_assoc()) {
                                echo <<< USERROW
                                <tr>
                                    <td class="dtr-control sorting_1" tabindex="0">$user[firstName]</td>
                                    <td>$user[lastName]</td>
                                    <td>$user[city]</td>
                                    <td>$user[created_at]</td>
                                    <td>$user[last_log]</td>
                                    <td>$user[role]</td>
                                </tr>
                            USERROW;
                            }
                            ?>
                            </tbody>
                            <tfoot>
                            <tr>
                                <th rowspan="1" colspan="1">Imię</th>
                                <th rowspan="1" colspan="1">Nazwisko</th>
                                <th rowspan="1" colspan="1">Miasto</th>
                                <th rowspan="1" colspan="1">Data utworzenia</th>
                                <th rowspan="1" colspan="1">Data ostatniego logowania</th>
                                <th rowspan="1" colspan="1">Rola</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>