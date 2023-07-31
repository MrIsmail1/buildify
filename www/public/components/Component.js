import generateStructure from '../core/DomRenderer.js';

class Component {
  constructor(props) {
    this.props = props;
    this.state = {};
    this.rootElement = '';
  }

  display(newProps = this.props) {
    const domElement = this.render();
    console.log(domElement);
    return this.render();
  }

  setState(newState) {
    this.state = { ...this.state, ...newState };
    this.display(this.props);
  }

  shouldUpdate(newProps) {
    return JSON.stringify(this.props) !== JSON.stringify(newProps);
  }

  render() {
    throw new Error('Render method should be overridden');
  }
}

export default Component;
