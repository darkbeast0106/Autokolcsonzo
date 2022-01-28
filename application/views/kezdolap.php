<div class="jumbotron">
    <h1>Köszöntelek az autókölcsönzőben</h1>
    <p>Kölcsönzéshez és további autók meghirdetéséhez kérlek regisztrálj, vagy jelentkezz be.</p>
</div>
<div class="row">
    <?php foreach ($autok as $auto) : ?>
        <div class="col-lg-3 col-md-4 col-sm-6 col-12 d-flex">
            <div class="card flex-fill">
                <div class="img-container card-header">
                    <img class="card-img-top" src="<?php echo base_url() . 'uploads/' . $auto['kep']; ?>" alt="Autó képe">
                </div>
                <div class="card-body">
                    <h5 class="card-title"><?php echo $auto['marka'] . ' - ' . $auto['modell'] ?></h5>
                    <p class="card-text"><?php echo strlen($auto['leiras']) > 75 ? substr($auto['leiras'], 0, 75) . "..." : $auto['leiras']  ?></p>
                </div>
                <div class="card-footer">
                    <p><?php echo $auto['eladasi_ar'] ?> Ft</p>
                    <button onclick="auto_reszletek(<?php echo $auto['id'] ?>)" class="btn btn-success" style="width: 100%;">Részletek</button>
                </div>
            </div>
        </div>

    <?php endforeach; ?>
</div>

<div class="modal" tabindex="-1" role="dialog" id="reszletek_modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Részletek</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <img class="col-12" id="reszletek_kep" src="<?php echo base_url() . 'uploads/ford_focus_2022_01_28_18_56_26_1.jpg' ?>" alt="Autó képe">
                </div>
                <h5>Autó adatai</h5>
                <table class="table">
                    <tbody>
                        <tr>
                            <th>Gyártó</th>
                            <td id="reszletek_gyarto">Ford</td>
                        </tr>
                        <tr>
                            <th>Modell</th>
                            <td id="reszletek_modell">Focus</td>
                        </tr>
                        <tr>
                            <th>Üzemanyag típúsa</th>
                            <td id="reszletek_uzemanyag">benzin</td>
                        </tr>
                        <tr>
                            <th>Gyártási év</th>
                            <td id="reszletek_ev">2020</td>
                        </tr>
                        <tr>
                            <th>Eladási ár</th>
                            <td id="reszletek_ar">3.000.000 Ft</td>
                        </tr>
                    </tbody>
                </table>

                <h6>Leírás</h6>
                <p id="reszletek_leiras">Lorem ipsum dolor sit amet consectetur adipisicing elit. Deserunt expedita recusandae consequatur vitae totam illum repudiandae quaerat ea, beatae animi natus asperiores nobis nesciunt aliquam cupiditate dolores illo voluptates in!</p>

                <h5>Hirdető adatai</h5>
                <table class="table">
                    <tbody>
                        <tr>
                            <th>E-mail</th>
                            <td id="reszletek_email">teszt@example.com</td>
                        </tr>
                        <tr>
                            <th>Tel</th>
                            <td id="reszletek_tel">+36301234567</td>
                        </tr>
                        
                    </tbody>
                </table>

                <h6 >További képek</h6>
                <div class="row" id="reszletek_tovabbi_kepek">
                    <img src="<?php echo base_url() . 'uploads/ford_focus_2022_01_28_18_56_26_1.jpg' ?>" alt="autó képe" class="col-12">
                    <img src="<?php echo base_url() . 'uploads/ford_focus_2022_01_28_18_56_26_1.jpg' ?>" alt="autó képe" class="col-12">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Bezárás</button>
            </div>
        </div>
    </div>
</div>

<script>
    function auto_reszletek(id) {
        let url = "<?php echo base_url() ?>api/auto/" + id;
        $.get(
            url,
            function(data, textStatus, jqXHR) {
                if (textStatus == "success") {
                    
                    $("#reszletek_modal").modal('show');
                }
            },
            "json"
        );
    }
</script>