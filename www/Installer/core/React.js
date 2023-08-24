import generateStructure from './DomRenderer.js';

export const MiniReact = {
  Component: class Component {
    props = null;
    newProps = {};
    domElement = null;

    constructor(props) {
      this.props = props;
    }
    setNewProps(newState) {
      this.newProps = { ...this.props, ...newState };
      this.display(this.newProps);
    }
    setDomElement(domElement) {
      this.domElement = domElement;
    }
    getDomElement() {
      return this.domElement;
    }

    display(newProps) {
      if (this.shouldUpdate()) {
        if (newProps != null) {
          this.props = newProps;
        }
        let result = this.render();
        this.domElement = result;
        return this.domElement;
      } else {
        let result = this.render();
        this.domElement = result;
        return this.domElement;
      }
    }

    shouldUpdate() {
      if (JSON.stringify(this.props) != JSON.stringify(this.newProps)) {
        return true;
      } else {
        return false;
      }
    }
  },

  createElement(type, props, ...children) {
    let node;
    let structure = {
      type: type,
      props: props,
      children: children.filter(Boolean),
    };
    node = generateStructure(structure);
    return node;
  },
  render(domElement, rootElement) {
    rootElement.appendChild(domElement);
  },
};
