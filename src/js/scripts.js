const regionSelectEl = document.querySelector('#region')
const comunaSelectEl = document.querySelector('#comuna')
const votarFormEl = document.querySelector('#votar-form')

regionSelectEl.addEventListener('change', async function(){
    region = regionSelectEl.value
    let response = await fetch(`/comunas?region=${region}`)
    let jsonData = await response.json()
    
    if ( jsonData.error ) {
        alert('Error: ' + jsonData.error)
        return
    } else {
        comunaSelectEl.length = 1;

        jsonData.data.forEach( comuna => {
            const newOption = document.createElement('option');
            newOption.text = comuna.nombre
            newOption.value = comuna.id
            comunaSelectEl.add(newOption)
        })
    }
})

votarFormEl.addEventListener('submit', async function(e){
    e.preventDefault()
    const formData = new FormData(votarFormEl);

    let response = await fetch(`/votar`, {
        method: 'POST',
        body: new URLSearchParams(formData)
    })
    let jsonData = await response.json()

    if ( jsonData.error ) {
        alert(jsonData.error)
        return
    } else {
        votarFormEl.reset()
        alert('¡El voto fue registrado correctamente!')
    }
})