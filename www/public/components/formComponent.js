export default function formComponent() {
  return {
    type: 'form',
    className: 'space-y-6',
    children: [
      {
        type: 'label',
        attributes: {
          for: 'host',
          className: 'block text-sm font-medium leading-6 text-gray-900',
        },
        children: ['Host'],
      },
      {
        type: 'input',
        attributes: {
          id: 'host',
          name: 'host',
          type: 'text',
          required: true,
          className:
            'block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6',
        },
      },
      {
        type: 'label',
        attributes: {
          for: 'dbname',
          className: 'block text-sm font-medium leading-6 text-gray-900',
        },
        children: ['Database name'],
      },
      {
        type: 'input',
        attributes: {
          id: 'dbname',
          name: 'dbname',
          type: 'text',
          required: true,
          className:
            'block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6',
        },
      },
      {
        type: 'label',
        attributes: {
          for: 'username',
          className: 'block text-sm font-medium leading-6 text-gray-900',
        },
        children: ['Username'],
      },
      {
        type: 'input',
        attributes: {
          id: 'username',
          name: 'username',
          type: 'text',
          required: true,
          className:
            'block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6',
        },
      },
      {
        type: 'label',
        attributes: {
          for: 'password',
          className: 'block text-sm font-medium leading-6 text-gray-900',
        },
        children: ['Password'],
      },
      {
        type: 'input',
        attributes: {
          id: 'password',
          name: 'password',
          type: 'password',
          required: true,
          className:
            'block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6',
        },
      },
    ],
  };
}
