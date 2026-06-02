<?php
include_once "header.php";
include_once "adminQuerys.php";
?>

<main>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card shadow-sm">
                    <div class="card-body mb-5">
                        <h5 class="card-title">Gerenciar Usuários</h5>
                        <hr>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped text-center">
                                <thead class="table-light">
                                    <tr>
                                        <th>ID</th>
                                        <th>Nome de Usuário</th>
                                        <th>Data e Hora de Criação</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (count($users) > 0): ?>
                                        <?php foreach ($users as $user): ?>
                                            <tr id="user-row-<?= $user['id'] ?>">
                                                <td><?= htmlspecialchars($user['id']) ?></td>
                                                <td><?= htmlspecialchars($user['username']) ?></td>
                                                <td><?= date('d/m/Y H:i:s', strtotime($user['data_criacao'])) ?></td>
                                                <td>
                                                    <div class="d-flex flex-column align-items-center gap-2">
                                                        <!-- Botão Alterar Senha -->
                                                        <button class="btn btn-sm btn-warning" style="width: 150px;" onclick="togglePasswordInput(<?= $user['id'] ?>)">Alterar Senha</button>
                                                        <form id="password-form-<?= $user['id'] ?>" action="adminConfig.php" method="POST" style="display: none; width: 100%;" class="mt-2">
                                                            <div class="input-group" style="width: 250px;">
                                                                <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
                                                                <input type="password" name="new_password" class="form-control form-control-sm" placeholder="Nova Senha" required>
                                                                <button type="submit" class="btn btn-sm btn-success">Confirmar</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </td>
                                                <td>
                                                    <form action="adminConfig.php" method="POST">
                                                        <input type="hidden" name="delete_user_id" value="<?= $user['id'] ?>">
                                                        <button type="submit" class="btn btn-sm btn-danger" style="width: 150px;" onclick="return confirm('Tem certeza que deseja deletar este usuário?')">Deletar</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="5">Nenhum usuário encontrado.</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                        <hr>
                        <div class="mt-4">
                            <h5 class="text-center">Cadastrar Novo Usuário</h5>
                            <form action="adminConfig.php" method="POST" class="d-flex justify-content-center align-items-center  gap-3 ">
                                <div class="input-group" style="width: auto;">
                                    <input type="text" class="form-control form-control-sm" id="new_username" name="new_username" placeholder="Nome de Usuário" required>
                                </div>
                                <div class="input-group" style="width: auto;">
                                    <input type="password" class="form-control form-control-sm" id="new_password" name="new_password" placeholder="Senha" required>
                                </div>
                                <button type="submit" class="btn btn-sm btn-primary" style="background-color: #5D737E" ;">Cadastrar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
    function togglePasswordInput(userId) {
        const form = document.getElementById(`password-form-${userId}`);
        const isVisible = form.style.display === 'block';
        form.style.display = isVisible ? 'none' : 'block';
    }
</script>

<?php include_once "footer.php"; ?>