import Button from './Button.js';
import Component from './Component.js';

export default class Counter extends Component {
  constructor(props) {
    super(props);
    this.state = { count: 0 };
    this.rootElement = 'counter-id';
  }

  render() {
    return {
      type: 'div',
      attributes: {
        id: 'counter-id',
      },
      children: [
        {
          type: 'p',
          children: [`Count: ${this.state.count}`],
        },
        {
          type: 'button',
          children: ['+'],
          events: {
            click: () => this.setState({ count: this.state.count + 1 }),
          },
        },
        {
          type: 'button',
          children: ['-'],
          events: {
            click: () => this.setState({ count: this.state.count - 1 }),
          },
        },
      ],
    };
  }
}
