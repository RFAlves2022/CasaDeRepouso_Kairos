// Preenche formulário ao clicar
document.querySelectorAll('.editable-row').forEach(row => {
    row.addEventListener('click', () => {
        document.getElementById('form-action').value = 'update';
        document.getElementById('medicamento-id').value = row.getAttribute('data-id');
        document.getElementById('resident_id').value = row.getAttribute('data-resident_id');
        document.getElementById('nome_medicamento').value = row.getAttribute('data-nome_medicamento');
        document.getElementById('horario').value = row.getAttribute('data-horario');
        document.getElementById('dosagem').value = row.getAttribute('data-dosagem');
        document.getElementById('via_adm').value = row.getAttribute('data-via_adm');
        document.getElementById('observacoes').value = row.getAttribute('data-observacoes');
        document.getElementById('submit-button').textContent = 'Atualizar Medicamento';
    });
});

// Reseta o formulário
document.addEventListener('DOMContentLoaded', () => {
    document.getElementById('form-action').value = 'create';
    document.getElementById('submit-button').textContent = 'Cadastrar Medicamento';
});

// Limpa os campos do formulário 
document.getElementById('new-button').addEventListener('click', () => {
    document.getElementById('form-action').value = 'create';
    document.getElementById('medicamento-id').value = '';
    document.getElementById('resident_id').value = '';
    document.getElementById('nome_medicamento').value = '';
    document.getElementById('horario').value = '';
    document.getElementById('dosagem').value = '';
    document.getElementById('via_adm').value = '';
    document.getElementById('observacoes').value = '';
    document.getElementById('submit-button').textContent = 'Cadastrar Medicamento';
});