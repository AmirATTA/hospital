const buttonClasses = [
  'tag-blue', 
  'tag-azure', 
  'tag-indigo', 
  'tag-purple', 
  'tag-pink',
  'tag-red',
  'tag-orange',
  'tag-yellow',
  'tag-lime',
  'tag-green',
  'tag-teal',
  'tag-cyan',
  'tag-gray',
  'tag-gray-dark',
];

const buttons = document.querySelectorAll('.tab-label');

buttons.forEach(button => {
  const randomClass = buttonClasses[Math.floor(Math.random() * buttonClasses.length)];
  button.classList.add(randomClass);
});
