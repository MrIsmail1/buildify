<header class="bg-gradient-to-r from-blue-500 to-green-400 text-white p-10">
    <div class="container mx-auto flex justify-between items-center">
        <h1 class="text-4xl">Buildify</h1>
        <?php if (!$isInstalled) :  ?>
            <button class="border rounded-md p-2 hover:-translate-y-1 animate-all">
                <a href="/bdfy-admin/installer/" class="text-2xl">Install buildify !</a>
            </button>
        <?php else : ?>
            <button class="border rounded-md p-2 hover:-translate-y-1 animate-all">
                <a href="/bdfy-admin/login" class="text-2xl">Login</a>
            </button>
        <?php endif; ?>
    </div>
</header>

<main class="p-10 bg-gray-100 min-h-screen">
    <section class="container mx-auto mb-10 bg-white p-10 rounded-lg shadow-lg">
        <?php if (htmlspecialchars(!$isInstalled)) :  ?>
            <h2 class="text-3xl mb-5 border-b-2 border-gray-300 pb-2">Welcome to our CMS website!</h2>
            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Reiciendis, quod.
            </p>
        <?php else : ?>
            <h2 class="text-3xl mb-5 border-b-2 border-gray-300 pb-2">Bienvenue dans notre CMS</h2>
            <p class="text-xl text-black font-bold">Aprés l'installation, créer une page Home a partir de votre dashboard pour remplacer cette page</p>
        <?php endif; ?>
    </section>

    <!-- Other sections go here -->
</main>