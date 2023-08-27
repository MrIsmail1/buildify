export default function generateStructure(structure) {
  if (!structure) {
    throw new Error('No structure provided');
  }

  if (typeof structure.type === 'string') {
    return generateDomElement(structure);
  } else if (typeof structure.type === 'function') {
    return generateComponent(structure);
  } else {
    throw new Error(`Unsupported structure type: ${structure.type}`);
  }
}

function generateDomElement({ type, props, children }) {
  const element = document.createElement(type);

  if (props) {
    applyProps(element, props);
  }

  if (children) {
    appendChildren(element, children);
  }

  return element;
}

function applyProps(element, props) {
  for (let propName in props) {
    if (propName === 'style' && typeof props[propName] === 'object') {
      // handle 'style' attribute separately
      const styles = props[propName];
      for (let styleName in styles) {
        element.style[styleName] = styles[styleName];
      }
    } else if (propName === 'className') {
      // handle 'className' attribute separately
      element.className = props[propName];
    } else if (/on([A-Z].*)/.test(propName)) {
      const eventName = propName.match(/on([A-Z].*)/)[1].toLowerCase();
      element.addEventListener(eventName, props[propName]);
    } else {
      element.setAttribute(propName, props[propName]);
    }
  }
}

function appendChildren(element, children) {
  for (let child of children) {
    let childElement;

    if (typeof child === 'string') {
      childElement = document.createTextNode(child);
    } else if (child instanceof HTMLElement) {
      childElement = child;
    } else {
      // Assuming child is a structure object
      childElement = generateStructure(child);
    }

    element.appendChild(childElement);
  }
}

function generateComponent({ type, props }) {
  const component = new type(props);
  return component.display();
}
