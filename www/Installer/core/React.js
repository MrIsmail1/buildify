import generateStructure from './DomRenderer.js';
export const MiniReact = {
  // Définition de la classe de base Component.
  Component: class Component {
    constructor(props) {
      // Initialisation du composant avec les props fournies et un état vide.
      this.props = props;
      this.state = {};
      // Stockage d'une référence au nœud virtuel DOM associé à ce composant.
      this._virtualNode = null;
    }
    // Méthode pour mettre à jour l'état du composant et déclencher un nouveau render.
    setState(newState) {
      const prevState = this.state;
      // Fusion de l'état précédent avec le nouvel état.
      this.state = { ...prevState, ...newState };
      // Déclenchement du processus de mise à jour.
      this.update(prevState);
    }

    // Méthode pour effectuer la mise à jour effective du composant.
    update(prevState) {
      // Génération d'un nouveau nœud virtuel DOM en appelant la méthode 'render'.
      const newVirtualNode = this.render();
      const currentVirtualNode = this._virtualNode;

      // Vérification de l'existence d'un nœud virtuel existant et si une mise à jour est nécessaire.
      if (currentVirtualNode && this.shouldUpdate(prevState)) {
        // Récupération de l'élément parent du nœud virtuel actuel.
        const parentElement = currentVirtualNode.parentElement;
        // Génération d'une nouvelle structure DOM à partir du nouveau nœud virtuel.
        const newElement = generateStructure(newVirtualNode);
        // Remplacement de l'ancien nœud virtuel par le nouveau dans le DOM.
        parentElement.replaceChild(newElement, currentVirtualNode);
        // Mise à jour de la référence au nœud virtuel.
        this._virtualNode = newElement;
      } else {
        // Si aucun nœud virtuel existant ou si aucune mise à jour n'est nécessaire, créer un nouveau nœud virtuel.
        this._virtualNode = generateStructure(newVirtualNode);
      }
    }

    // Méthode pour déterminer si une mise à jour est nécessaire en fonction de la comparaison de l'état.
    shouldUpdate(prevState) {
      // Comparaison de la représentation JSON de l'état actuel et de l'état précédent.
      return JSON.stringify(this.state) !== JSON.stringify(prevState);
    }

    // Méthode devant être implémentée par les sous-classes pour définir la logique de render.
    render() {
      throw new Error(
        'Les sous-classes doivent implémenter la méthode de render.'
      );
    }

    // Méthode pour générer et retourner le nœud virtuel DOM pour le render.
    display() {
      const newVirtualNode = this.render();
      this._virtualNode = generateStructure(newVirtualNode);
      return this._virtualNode;
    }
  },

  // Fonction pour créer un élément virtuel DOM.
  createElement(type, props, ...children) {
    return {
      type, // Type d'élément HTML ou type de composant.
      props: props || {}, // Propriétés de l'élément ou du composant.
      children: children.filter(Boolean), // Filtrage des enfants non valides.
    };
  },

  // Fonction pour rendre un nœud virtuel DOM dans un élément DOM réel.
  render(virtualNode, rootElement) {
    rootElement.appendChild(virtualNode);
  },
};
