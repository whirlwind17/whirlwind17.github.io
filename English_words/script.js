let vocab = {
    "transfer curve": "傳輸特性曲線",
    "active region": "作用區",
    "amplifier": "放大器",
    "amplitude distortion": "振幅失真",
    "barrier potential": "障壁電壓",
    "bias": "偏壓",
    "bipolar": "雙極性",
    "emitter": "射極",
    "base": "基極",
    "collector": "集極",
    "bridge rectifier": "橋式整流",
    "carrier": "載子",
    "clipping": "截波",
    "cut-off region": "截止區",
    "pinch-off region": "夾止區",
    "saturation region": "飽和區",
    "linear-active region": "線性放大區",
    "depletion region": "空乏區",
    "diffusion": "擴散",
    "load line": "負載線",
    "ohmic region": "歐姆區",
    "electron-hole pair": "電子電洞對",
    "extrinsic semiconductor": "外質半導體",
    "source": "源極",
    "drain": "汲極",
    "gate": "閘極",
    "low pass filter": "低通濾波器",
    "high pass filter": "高通濾波器",
    "band pass filter": "帶通濾波器",
    "band reject filter": "帶(阻)拒濾波器",
    "all pass filter": "全通濾波器",
    "active Filter": "主動濾波器",
    "passive Filter": "被動/無源濾波器PF",
    "gain": "增益",
    "peak inverse voltage": "逆向峰值電壓",
    "phase distortion": "相位失真",
    "operating point": "工作點",
    "quiescent operating point": "靜態工作點",
    "junction": "接面",
    "threshold": "臨界",
    "unipolar": "單極性",
    "thyristor": "晶閘管",
    "(BT) Bipolar transistor": "雙極性電晶體",
    "(UT) Unipolar transistor": "單極性電晶體",
    "(BJT) Bipolar junction transistor": "雙極性接面電晶體",
    "(FET) Field-effect transistor": "場效應電晶體",
    "(JFET) Junction Field-effect transistor": "接面場效應電晶體",
    "(MOSFET) Metal Oxide Semiconductor Field-Effect-Transistor": "金氧半場效應電晶體",
  };
  
  let wordsToLearn = Object.keys(vocab);
  let learnedWords = [];
  let mistakes = [];
  let repeatButton = null; // 新增一個全域變數來存放 Repeat 按鈕的參考
  
  // Initialize speech synthesis
  let synth = window.speechSynthesis;
  
  function getRandomWord() {
    return wordsToLearn[Math.floor(Math.random() * wordsToLearn.length)];
  }
  
  function speak(word) {
    // Cancel the current speech if any
    synth.cancel();
  
    let utterThis = new SpeechSynthesisUtterance(word);
    utterThis.lang = 'en-US'; // Set the language to English (you can change this if needed)
    synth.speak(utterThis);
  }
  
  function getWordWithoutParentheses(word) {
    // Remove parentheses and trim any extra spaces
    return word.replace(/\(.*?\)/g, '').trim();
  }
  
  function repeatWord() {
    let word = document.getElementById('question').textContent.split(': ')[1].trim(); // Extract the word from the question text
    speak(word);
  }
  
  function checkAnswer() {
    let word = getRandomWord();
    let isChinese = Math.random() < 0.5; // Randomly choose to display Chinese or English
  
    if (isChinese) {
      let chineseTranslation = vocab[word];
      document.getElementById('question').textContent = `Please enter the English translation for: ${chineseTranslation}`;
      speak(word); // Speak the word itself
    } else {
      let englishWord = getWordWithoutParentheses(word);
      document.getElementById('question').textContent = `Please enter the Chinese translation for: ${englishWord}`;
      speak(word); // Speak the word itself
    }
  
    let answerInput = document.getElementById('answer');
    answerInput.value = '';
    answerInput.focus();
  
    answerInput.onkeydown = function(event) {
      if (event.key === "Enter") {
        let answer = answerInput.value.trim().toLowerCase();
        let correctAnswer = isChinese ? word : vocab[word];
  
        let correctEnglishWord = getWordWithoutParentheses(word);
  
        // Check if the answer matches either the full word or the word within parentheses
        if (answer === correctAnswer.toLowerCase() || answer === correctEnglishWord.toLowerCase()) {
          alert('Correct!');
          learnedWords.push(word);
        } else {
          alert(`Incorrect. The correct answer is: ${correctAnswer}`);
          mistakes.push({ word: word, correctAnswer: correctAnswer });
        }
  
        wordsToLearn = wordsToLearn.filter(w => !learnedWords.includes(w));
  
        if (wordsToLearn.length === 0) {
          alert('Congratulations! You have learned all the words.');
        } else {
          checkAnswer(); // Proceed to the next question
        }
      }
    };
  
    // Remove existing repeat button, if any
    if (repeatButton) {
      repeatButton.parentNode.removeChild(repeatButton);
    }
  
    // Create a repeat button
    repeatButton = document.createElement('button');
    repeatButton.textContent = 'Repeat';
    repeatButton.onclick = repeatWord;
    document.getElementById('quiz-container').appendChild(repeatButton);
  }
  
  function showMistakes() {
    let mistakesList = document.getElementById('mistakes-list');
    mistakesList.innerHTML = '';
  
    mistakes.forEach((item, index) => {
      let listItem = document.createElement('li');
      listItem.textContent = `${item.word} - Correct Answer: ${item.correctAnswer}`;
      mistakesList.appendChild(listItem);
    });
  
    document.getElementById('mistakes-container').style.display = 'block';
  }
  