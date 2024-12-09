import { THasChildren } from '@/types';
import { useEffect, useState } from 'react';
import { createPortal } from 'react-dom';

type BaseModalProps = THasChildren;

export const MODAL_ROOT_ID = 'modals';

export default function BaseModal({ children }: BaseModalProps) {
  const [root, setRoot] = useState<HTMLElement | null>(null);

  useEffect(() => {
    setRoot(document.getElementById(MODAL_ROOT_ID));
  }, []);

  if (!root) return children;

  return createPortal(children, root);
}
