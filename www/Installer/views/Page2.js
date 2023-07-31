import { BrowserLink } from '../components/BrowserRouter.js';
import Counter from '../components/Counter.js';
import { Link } from '../components/Link.js';
import formComponent from '../components/formComponent.js';

export default function Page2() {
  return {
    type: 'div',
    attributes: {
      id: 'divv',
      className: 'flex h-screen w-full',
    },
    children: [
      BrowserLink('Page 1', '/page1'),
      Link('Index', '/'),
      Link('Page 1', '/articles/page1'),
    ],
  };
}
