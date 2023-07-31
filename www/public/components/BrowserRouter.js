import DomRenderer from '../core/DomRenderer.js';
import { Link } from './Link.js';

let routerBasePath; // Déclare une variable globale routerBasePath

export default function BrowserRouter(routes, rootElement, baseUrl = '') {
  routerBasePath = baseUrl; // Initialise la variable routerBasePath avec la valeur de baseUrl
  const pathname = location.pathname.replace(routerBasePath, ''); // Récupère le chemin d'accès actuel et supprime le routerBasePath s'il est présent
  rootElement.appendChild(DomRenderer(routes[pathname]())); // Ajoute le contenu rendu par DomRenderer pour la route correspondant au pathname dans l'élément rootElement

  const oldPushState = history.pushState; // Sauvegarde la fonction pushState d'origine de l'historique
  history.pushState = function (data, unused, url) {
    oldPushState.call(history, data, unused, url); // Appelle la fonction pushState d'origine avec les mêmes arguments
    window.dispatchEvent(new Event('popstate')); // Déclenche un événement popstate sur la fenêtre
  };

  window.addEventListener('popstate', function () {
    const pathname = location.pathname.replace(routerBasePath, ''); // Récupère le chemin d'accès actuel et supprime le routerBasePath s'il est présent

    rootElement.replaceChild(
      DomRenderer(routes[pathname]()), // Remplace le contenu de rootElement par le contenu rendu par DomRenderer pour la nouvelle route correspondant au pathname
      rootElement.childNodes[0] // Remplace le premier enfant de rootElement
    );
  });
}

export function BrowserLink(title, link) {
  const realLink = routerBasePath + link; // Concatène le routerBasePath avec le lien spécifié
  return Link(title, realLink, (event) => {
    event.preventDefault(); // Empêche le comportement par défaut du lien
    history.pushState({}, undefined, realLink); // Modifie l'URL de la page sans recharger la page
  });
}
