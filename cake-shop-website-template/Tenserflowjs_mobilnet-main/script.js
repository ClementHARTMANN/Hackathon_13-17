// function selectProbability(probabilityIndex, predictions) {
//   const selectedProbability = predictions[probabilityIndex];
//   const selectedObject = selectedProbability.className;
//   const output = document.getElementById('output');
//   output.innerHTML += `<p class="col-lg-6 col-md-8 col-sm-12">${selectedObject}</p>`;

//   // add event listener to the button to display the selected object
//   const button = document.getElementById(`prediction-${probabilityIndex}`);
//   button.addEventListener('click', () => {
//     console.log('hello')
//     output.innerHTML += `<p class="col-lg-6 col-md-8 col-sm-12">${selectedObject}</p>`;
//   });
// }
function selectprobability(nom){
  console.log(nom)
    let output = document.getElementById('output');

  output.innerHTML += `<p>${nom}</p>`;
}



function process(img_){
     // Load the model.
     document.getElementById('output').innerHTML+=`<img class="col-lg-6 col-md-8 col-sm-12 image_out" src=${img_.src}  />`
     
     mobilenet.load().then(model => {
        // Classify the image.
        model .classify(img_).then(predictions => {
        
          console.log('Predictions: ');
          console.log(predictions);
         
          const predictionList = `
          <div class="card" >
            <ul class="list-group list-group-flush">
              <li class="list-group-item"><button onclick="selectprobability('${predictions[0].className}')" id="prediction-0">${predictions[0].className} | Probability: ${(predictions[0].probability)*100}%</button></li>
              <li class="list-group-item"><button onclick="selectprobability('${predictions[1].className}')" id="prediction-1">${predictions[1].className} | Probability: ${(predictions[1].probability)*100}%</button></li>
              <li class="list-group-item"><button onclick="selectprobability('${predictions[2].className}')" id="prediction-2">${predictions[2].className} | Probability: ${(predictions[2].probability)*100}%</button></li>
            </ul>
          </div>`;

          document.getElementById('details').innerHTML+= predictionList;
        });
      });
}

function up_img(event){
    const img1 = new Image()
    var filename=URL.createObjectURL(event.target.files[0]);
      img1.src=filename;
      img1.crossOrigin = null;
      process(img1);
  }

function img_search(){
    const img2 = new Image()
    var filename=document.getElementById('upload_link').value;
      console.log(filename);
      img2.src=filename;
      img2.crossOrigin = "anonymous";
      process(img2);
} 
