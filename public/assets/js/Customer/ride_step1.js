

    // logout button------------------------------------------------------------------------------------------------
    const logout_option = document.querySelector('.linkbutton2')
    const logout_container = document.querySelector('.logout-container')
    const cancel_button = document.querySelector('.cancel-btn')
    const main = document.querySelector('.activity')
   const logout_button = document.querySelector('.logout-btn')
        logout_option.addEventListener('click',()=>{
            logout_container.style.display = 'block'
            main.style.display='none'
            })

            cancel_button.addEventListener('click', ()=>{
            logout_container.style.display = 'none'
            main.style.display='block'
            })

            logout_button.addEventListener('click', ()=>{
                window.location.href = "<?=ROOT?>/logout";
            })
    