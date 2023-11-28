<div class="flex flex-col items-center gap-10 border-none sm:border-2  border-[#FF9A02] bg-black rounded-2xl px-14 py-10">
    <h1 class=" uppercase text-[#FF9A02] text-xl md:text-2xl lg:text-3xl font-semibold">Inscription</h1>
    <div class="flex flex-col items-center">
        <div class="w-[70px] h-[70px] bg-white rounded-full border-2 border-[#FF9A02] flex items-center justify-center cursor-pointer">
            <ion-icon class="text-[#FF9A02] text-4xl font-bold " name="mic"></ion-icon>
        </div>
        <h1 class="">Commerçant</h1>
    </div>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post" enctype="multipart/form-data">
        <div class="flex flex-col items-center gap-6">
            <div class="flex justify-center flex-col sm:flex-row  items-center gap-20">
                <div class="flex flex-col gap-2">
                    <div class="flex flex-col gap-2 text-black">
                        <label class="text-white" for="prenom">Prénom:</label>
                        <input class="rounded-sm py-1 pl-2 w-[300px] sm:w-[400px]  focus:outline-none" type="text" id="prenom" name="prenom">
                    </div>

                    <div class=" flex flex-col gap-2 text-black">
                        <label class="text-white" for="nom">Nom:</label>
                        <input class="rounded-sm py-1 pl-2 w-[300px] sm:w-[400px]  focus:outline-none" type="text" id="nom" name="nom">
                    </div>

                    <div class=" flex flex-col gap-2 text-black">
                        <label class="text-white" for="email">Email:</label>
                        <input class="rounded-sm py-1 pl-2 w-[300px] sm:w-[400px]  focus:outline-none" type="email" id="email" name="email">
                    </div>

                    <div class=" flex flex-col gap-2 text-black">
                        <label class="text-white" for="telephone">Téléphone:</label>
                        <input class="rounded-sm py-1 pl-2 w-[300px] sm:w-[400px]  focus:outline-none" type="tel" id="telephone" name="telephone">
                    </div>

                    <div class=" flex flex-col gap-2 text-black">
                        <label class="text-white" for="password">Mot de passe:</label>
                        <input class="rounded-sm py-1 pl-2 w-[300px] sm:w-[400px]  focus:outline-none" type="password" id="password" name="password">
                    </div>
                </div>
            </div>

            <div>
                <button type="button" class="inline-flex items-center justify-center rounded-md py-1.5 px-7 bg-[#FF9A02]">Valider</button>
            </div>
        </div>
    </form>
</div>