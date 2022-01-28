<h2 class="mt-3">Bejelentkezés</h2>
<form action="<?php base_url(); ?>bejelentkezes" method="POST">
    <div class="form-group">
        <label for="felhasznalonev">Felhasználónév:</label>
        <input type="text" class="form-control" id="felhasznalonev" placeholder="Felhasználónév" name="felhasznalonev" required>
    </div>
    <div class="form-group">
        <label for="jelszo">Jelszó:</label>
        <input type="password" class="form-control" id="jelszo" placeholder="Jelszó" name="jelszo" required>
    </div>
    <button type="submit" class="btn btn-primary">Bejelentkezés</button>
</form>