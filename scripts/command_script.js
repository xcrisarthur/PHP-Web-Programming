function updateGenreValue(id) {
    window.location = "?menu=genu&gid=" + id;
}

function deleteGenreValue(id) {
    let confirmation = window.confirm("Serius?");
    if (confirmation){
        window.location = "?menu=genre&cmd=del&gid=" + id;
    }
}

function updateBookValue(id) {
    window.location = "?menu=booku&bid=" + id;
}

function deleteBookValue(id) {
    let confirmation = window.confirm("Serius?");
    if (confirmation){
        window.location = "?menu=book&cmd=del&bid=" + id;
    }
}