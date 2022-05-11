const inputPrice = document.querySelector('#price')

inputPrice.addEventListener('keypress', (e) => {
    const keyCode = (e.keyCode ? e.keyCode : e.wich)

    if(keyCode > 57 && keyCode < 127){
        e.preventDefault()
    }
})

let btnCloseError = document.querySelector('#btn-close-error')
    btnCloseError.addEventListener('click', (e) => {
        document.querySelector('.error').style.display = "none";
})