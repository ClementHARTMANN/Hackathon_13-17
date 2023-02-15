// Sélection des éléments HTML pertinents
const weightInput = document.getElementById("weight");
const heightInput = document.getElementById("height");
const ageInput = document.getElementById("age");
const genderInput = document.getElementById("gender");
const activityInput = document.getElementById("activity");
const goalInput = document.getElementById("goal");
const resultContainer = document.getElementById("result");

// Fonction de calcul du BMR
function calculateBMR(weight, height, age, gender) {
  if (gender === "male") {
    return 10 * weight + 6.25 * height - 5 * age + 5;
  } else {
    return 10 * weight + 6.25 * height - 5 * age - 161;
  }
}

// Fonction de calcul du TDEE
function calculateTDEE(bmr, activity) {
  return bmr * activity;
}

// Fonction de calcul des objectifs de prise ou perte de poids
function calculateGoals(tdee, goal) {
  const proteinGrams = 1.7 * weightInput.value;
  const proteinCalories = proteinGrams * 4;
  const fatGrams = 0.8 * weightInput.value;
  const fatCalories = fatGrams * 9;
  const totalNutrientCalories = proteinCalories + fatCalories;
  let calorieDifference = 0;
  
  if (goal === "maintain") {
    calorieDifference = 0;
  } else if (goal === "cut") {
    calorieDifference = -200;
  } else if (goal === "bulk") {
    calorieDifference = 200;
  }
  
  const totalCalories = tdee + calorieDifference;
  const carbCalories = totalCalories - totalNutrientCalories;
  const carbGrams = carbCalories / 4;
  
  return {
    proteinGrams,
    proteinCalories,
    fatGrams,
    fatCalories,
    carbGrams,
    carbCalories,
    totalCalories,
    calorieDifference
  };
}

// Fonction de mise à jour de l'affichage des résultats
function updateResult() {
  const weight = parseFloat(weightInput.value);
  const height = parseFloat(heightInput.value);
  const age = parseFloat(ageInput.value);
  const gender = genderInput.value;
  const activity = parseFloat(activityInput.value);
  const goal = goalInput.value;
  
  const bmr = calculateBMR(weight, height, age, gender);
  const tdee = calculateTDEE(bmr, activity);
  const goals = calculateGoals(tdee, goal);
  
// Affichage des résultats
const resultContainer = document.getElementById("result-container");
resultContainer.innerHTML = `
  <h2>Vos besoins en calories</h2>
  <ul>
    <li>Maintien : ${maintenanceCalories.toFixed(0)} kcal</li>
    <li>Sèche : ${cuttingCalories.toFixed(0)} kcal</li>
    <li>Prise de masse : ${bulkingCalories.toFixed(0)} kcal</li>
  </ul>
  <h2>Vos besoins en nutriments</h2>
  <ul>
    <li>Protéines : ${proteinNeeds.toFixed(0)} g soit ${proteinCalories.toFixed(0)} kcal</li>
    <li>Lipides : ${fatNeeds.toFixed(0)} g soit ${fatCalories.toFixed(0)} kcal</li>
    <li>Glucides : ${carbCalories.toFixed(0)} kcal</li>
  </ul>
`;
};