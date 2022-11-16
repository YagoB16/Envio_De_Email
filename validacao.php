@import url(//db.onlinewebfonts.com/c/3ee28cd1f75331502eb4d62fa3e142c9?family=Exquisite+Corpse);
@import url(//db.onlinewebfonts.com/c/6b43dc31ba4fb1a3478a21e4118a54bc?family=Ravenscroft);

@font-face {
  font-family: "Exquisite Corpse";
  src: url("//db.onlinewebfonts.com/t/3ee28cd1f75331502eb4d62fa3e142c9.eot");
  src: url("//db.onlinewebfonts.com/t/3ee28cd1f75331502eb4d62fa3e142c9.eot?#iefix")
      format("embedded-opentype"),
    url("//db.onlinewebfonts.com/t/3ee28cd1f75331502eb4d62fa3e142c9.woff2")
      format("woff2"),
    url("//db.onlinewebfonts.com/t/3ee28cd1f75331502eb4d62fa3e142c9.woff")
      format("woff"),
    url("//db.onlinewebfonts.com/t/3ee28cd1f75331502eb4d62fa3e142c9.ttf")
      format("truetype"),
    url("//db.onlinewebfonts.com/t/3ee28cd1f75331502eb4d62fa3e142c9.svg#Exquisite Corpse")
      format("svg");
}

@font-face {
  font-family: "Ravenscroft";
  src: url("//db.onlinewebfonts.com/t/6b43dc31ba4fb1a3478a21e4118a54bc.eot");
  src: url("//db.onlinewebfonts.com/t/6b43dc31ba4fb1a3478a21e4118a54bc.eot?#iefix")
      format("embedded-opentype"),
    url("//db.onlinewebfonts.com/t/6b43dc31ba4fb1a3478a21e4118a54bc.woff2")
      format("woff2"),
    url("//db.onlinewebfonts.com/t/6b43dc31ba4fb1a3478a21e4118a54bc.woff")
      format("woff"),
    url("//db.onlinewebfonts.com/t/6b43dc31ba4fb1a3478a21e4118a54bc.ttf")
      format("truetype"),
    url("//db.onlinewebfonts.com/t/6b43dc31ba4fb1a3478a21e4118a54bc.svg#Ravenscroft")
      format("svg");
}

::-webkit-scrollbar{
  width: 15px;
}
::-webkit-scrollbar-track{
  background-color: rgba(62,6,95,1);
}
::-webkit-scrollbar-button{
  background-color: rgb(66, 12, 97);
}
::-webkit-scrollbar-thumb{
  background-color:rgb(66, 12, 97);
}
::-webkit-scrollbar-thumb:hover{
  background-color: #8e05c2;
}

* {
  box-sizing: border-box;
}

html {
  min-height: 100%;
  background: rgb(142,5,194);
  background: linear-gradient(47deg, rgba(142,5,194,1) 0%, rgba(117,5,80,1) 64%, rgba(62,6,95,1) 99%);
}

.container-header {
  padding: 30px;
  text-align: left;
}
.container-header h1 {
  font-family: "Exquisite Corpse";
  font-size: 65px;
}

.container-main {
  display: flex;
  align-items: flex-start;
}

.div-bio {
  width: 50%;
  padding-right: 20px;
}

.div-bio h2 {
  font-size: 60px;
  font-family: Ravenscroft;
}
.div-bio p {
  font-size: 35px;
  font-family: Ravenscroft;
}

.div-form {
  width: 40%;
  max-width: 500px;
  padding: 1em;
  border: 0.1px solid rgba(163, 7, 202, 0.863);
  border-radius: 1em;
  background: transparent;
}

.div-erro{
  width: 30%;
  align-items: center;
  padding: 10px 40px 0 90px;
  
}
.div-erro h1{
  font-size: 30px;
}



.form__group {
  position: relative;
  padding: 15px 0 0;
  margin-top: 10px;
  width: 50%;
  font-family: "Exquisite Corpse";
}

.form__field {
  font-family: "inherit";
  width: 200%;
  border: 0;
  border-bottom: 2px solid rgb(32, 2, 31);
  outline: 0;
  font-size: 1.3rem;
  color: rgb(249, 245, 245);
  padding: 7px 0 0 0;
  background: transparent;
  transition: border-color 0.2s;
}

::placeholder {
  color: transparent;
}

:placeholder-shown ~ .form__label {
  font-size: 1.3rem;
  cursor: text;
  top: 20px;
}

.form__label {
  position: absolute;
  top: 0;
  display: block;
  transition: 0.2s;
  font-size: 1rem;
  color: rgb(177, 161, 176);
}

.form__field:focus {
  padding-bottom: 3px;
  font-weight: 700;
  border-width: 3px;
  border-image: linear-gradient(to right, rgb(103, 70, 98), rgb(12, 1, 10));
  border-image-slice: 1;
}

.form__field:focus ~ .form__label {
  position: absolute;
  top: 0;
  display: block;
  transition: 0.2s;
  font-size: 1.4rem;
  color: rgb(50, 17, 75);
  font-weight: 700;
}

input:internal-autofill-selected {
  appearance: none;
  background-image: none !important;
  background-color: -internal-light-dark(
    rgb(83, 7, 170),
    rgba(233, 7, 41, 0.4)
  ) !important;
  color: fieldtext !important;
}

/* reset input */
.form__field:invalid,
.form__field:required {
  box-shadow: none;
}

.msg-box {
  padding-top: 5%;
  font-size: 25px;
  
}

#msg {
  border: 1px solid rgb(58, 14, 91);
  border-radius: 5px;
  width: 100%;
  height: 10rem;
  background: transparent;
  
}

textarea:valid {
  border: 2px solid lime;
}

button {
  align-items: center;
  margin: 20px;
}
.btn {
  padding: 3% 45% 0 29%;
}
.custom-btn {
  width: 130px;
  height: 40px;
  color: #fff;
  border-radius: 5px;
  padding: 10px 25px;
  font-family: "Lato", sans-serif;
  font-weight: 500;
  background: transparent;
  cursor: pointer;
  transition: all 0.3s ease;
  position: relative;
  display: inline-block;
  box-shadow: inset 2px 2px 2px 0px rgba(255, 255, 255, 0.5),
    7px 7px 20px 0px rgba(0, 0, 0, 0.1), 4px 4px 5px 0px rgba(0, 0, 0, 0.1);
  outline: none;
}
.btn-11 {
  border: none;
  background: rgba(145, 6, 135);
  background: linear-gradient(0deg, rgb(135, 14, 156) 0%, rgb(41, 6, 44) 100%);
  color: #fff;
  overflow: hidden;
}
.btn-11:hover {
  text-decoration: none;
  color: #fff;
}
.btn-11:before {
  position: absolute;
  content: "";
  display: inline-block;
  top: -180px;
  left: 0;
  width: 30px;
  height: 100%;
  background-color: #fff;
  animation: shiny-btn1 3s ease-in-out infinite;
}
.btn-11:hover {
  opacity: 0.7;
}
.btn-11:active {
  box-shadow: 4px 4px 6px 0 rgba(255, 255, 255, 0.3),
    -4px -4px 6px 0 rgba(116, 125, 136, 0.2),
    inset -4px -4px 6px 0 rgba(255, 255, 255, 0.2),
    inset 4px 4px 6px 0 rgba(0, 0, 0, 0.2);
}

@-webkit-keyframes shiny-btn1 {
  0% {
    -webkit-transform: scale(0) rotate(45deg);
    opacity: 0;
  }
  80% {
    -webkit-transform: scale(0) rotate(45deg);
    opacity: 0.5;
  }
  81% {
    -webkit-transform: scale(4) rotate(45deg);
    opacity: 1;
  }
  100% {
    -webkit-transform: scale(50) rotate(45deg);
    opacity: 0;
  }
}

.container-footer {
  display: flex;
}
#logo-footer {
  width: 40px;
}

.fundo {
  position: relative;
  width: 100%;
  background-color: transparent;
  display: flex;
  align-items: center;
}

.fundo .bruxa {
  position: relative;
  animation: animate 5.5s ease-in-out infinite;
}

@keyframes animate {
  0% {
    transform: translateX(-1px);
  }
  50% {
    transform: translateX(900px);
  }
}
