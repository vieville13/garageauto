<body>
<div class="container mt-5">
    <h2>Supprimer un utilisateur</h2>
         <form method="POST" id = "formDeleteUser" enctype="multipart/form-data" action = "../../index.php?page=user&action=delete">
        <div class="form-group">
            <label for="userSelect">Sélectionnez un utilisateur</label>
            <select class="form-control" id="userSelect">
                <option value="" disabled selected>Choisissez un utilisateur</option>
                <?php foreach ($users as $user) { 
                if ($user->getAdmin() !== true){?>
                <option value="<?php $user->getId() ?>"><?php $user->getEmail() ?></option>
              <?php }
                }?>
            </select>
        </div>
        <button type="submit" class="btn btn-danger">Supprimer</button>
    </form>
</div>
</body>