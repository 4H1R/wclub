import { createInertiaApp } from '@inertiajs/react';
import { createRoot, hydrateRoot } from 'react-dom/client';
import '../css/app.css';
import config from './fixtures/config';
import { resolveComponent } from './utils/inertia';

createInertiaApp({
  title: (title) => title,
  resolve: resolveComponent,
  setup({ el, App, props }) {
    if (import.meta.env.SSR) {
      hydrateRoot(el, <App {...props} />);
      return;
    }

    createRoot(el).render(<App {...props} />);
  },
  progress: {
    color: config.primaryColor,
    showSpinner: true,
  },
});
