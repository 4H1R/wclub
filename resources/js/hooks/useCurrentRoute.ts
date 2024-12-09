import { usePage } from '@inertiajs/react';

export default function useCurrentRoute() {
  const currentRoute = usePage().url.split('?').at(0);

  return currentRoute as string;
}
