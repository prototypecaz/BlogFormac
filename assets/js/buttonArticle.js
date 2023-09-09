function fetchJson(url){
 return   fetch(url)
.then(function(response) {
  return response.json() // Renvoie un tableau associatif manipulable par javascript (format json)
        
    })

}