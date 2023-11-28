<footer>

    <div class="about">
        <h3>SPOTLIGHT</h3>
        <p>Votre application qui vous permet de trouver des évènements liés à leur position géographique mais aussi d'en ajouter</p>

        <div class="icone">
            <img src="../Icone/instagram.svg">
            <img src="../Icone/twitter.svg">
            <img src="../Icone/tiktok.svg">
        </div>
    </div>


    <div class="categorie">
        <h3>Catégories</h1>
        <p>DÉBAT</p>
        <p>PHOTOGRAPHIE</p>
        <p>CINÉMA</p>
        <p>MUSIQUE</p>
        <p>LITTÉRATURE</p>
        <p>PEINTURE</p>
        <p>JEUX DE RÔLES</p>
    </div>

    <div class="musique">
        <h3>Musique</h1>
        <p>Tech</p>
        <p>Rock</p>
        <p>Jazz</p>
        <p>Alternatif</p>
        <p>Pop</p>
        <p>Pop Rock</p>
        <p>Rap</p>
    </div>

    <div class="contact">
        <h3>Contact</h3>
        <div class="input-container">
            <input type="text" id="input" required="">
            <label for="input" class="label">Enter Text</label>
            <div class="underline"></div>
          </div>
    </div>

</footer>


<Style>
    footer {
  display: flex;
  justify-content: center;
  align-items: center;
  width: 100%;
  padding-top: 100px;
}

footer h3{
  text-align: left;
  color: white;
}

.about{
  display: flex;
  flex-direction: column;
  margin-right: 100px;
  margin-bottom: 80px;

} 

.about p {
  width: 400px;
  text-align: left;
  margin-top: 20px;
  margin-bottom: 20px;
}

.about img{
  display: inline-block;
  margin-right: 25px;
  height: 30px;
  margin-bottom: 20px;
}

.categorie{
  display: flex;
  flex-direction: column;
  margin-right: 100px;
}

.categorie p {
  text-align: left;
  font-size: 15px;
}

.categorie h3{
  margin-bottom: 20px;
}



.musique{
  display: flex;
  flex-direction: column;
  margin-right: 100px;

}

.musique p {
  text-align: left;
  font-size: 15px;
}

.musique h3{
  margin-bottom: 20px;
}


.contact {
  display: flex;
  flex-direction: column;
  margin-right: 100px;
  margin-bottom: 76px;

}

</Style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
    const popupTriggers = document.querySelectorAll('.popup-trigger');
    const popup = document.getElementById('donate-popup');
    const closePopup = document.getElementById('close-popup');
    const blurBackground = document.createElement('div');
    blurBackground.classList.add('blur');

    popupTriggers.forEach(trigger => {
        trigger.addEventListener('click', function () {
            popup.classList.add('active');
            document.body.appendChild(blurBackground);
        });
    });

    closePopup.addEventListener('click', function () {
        popup.classList.remove('active');
        blurBackground.remove();
    });
});

</script>