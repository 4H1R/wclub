import config from '@/fixtures/config';
import { THasChildren } from '@/types';
import { useEffect, useState } from 'react';
import { createPortal } from 'react-dom';

type BaseModalProps = THasChildren;

export default function BaseModal({ children }: BaseModalProps) {
  const [root, setRoot] = useState<HTMLElement | null>(null);

  useEffect(() => {
    setRoot(document.getElementById(config.modalsId));
  }, []);

  if (!root) return children;

  return createPortal(children, root);
}
