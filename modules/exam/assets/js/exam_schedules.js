function validateToken(el)
{
    const token = prompt('Masukan Token : ')
    if(token == '')
    {
        alert('Token tidak boleh kosong')
        return false
    }

    const valid = token == el.dataset.token

    if(!valid)
    {
        alert('Token tidak valid')
        return false
    }
}