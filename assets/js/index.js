
    function remove (name, id) {
        if (confirm("Вы действительно хотите удалить эту запись?")) {
            window.location.href = `./${name}_delete.php?id=${id}`;
        }
    }