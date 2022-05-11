const inputName = document.querySelector('#category-name')

document.querySelector('#category-name').addEventListener('keypress', (e) => {
    const keyCode = (e.keyCode ? e.keyCode : e.wich)

    if(keyCode > 47 && keyCode < 58){
        e.preventDefault()
    }
})

let btnCloseError = document.querySelector('#btn-close-error')
    btnCloseError.addEventListener('click', (e) => {
        document.querySelector('.error').style.display = "none";
})