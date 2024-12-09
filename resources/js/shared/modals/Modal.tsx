import { closeModal, cn } from '@/utils';
import React from 'react';
import BaseModal from './BaseModal';

export interface ModalProps extends React.DialogHTMLAttributes<HTMLDialogElement> {
  id: string;
  children: React.ReactNode;
  parentClassName?: string;
  dialogClassName?: string;
  parentElement?: 'div' | 'form';
  closeOnClickOutside?: boolean;
}

export default function Modal({
  children,
  closeOnClickOutside = false,
  dialogClassName,
  parentClassName,
  parentElement = 'form',
  ...props
}: ModalProps) {
  const parentProps = { className: cn('modal-box space-y-4', parentClassName) };

  return (
    <BaseModal>
      <dialog {...props} className={cn('modal', dialogClassName)}>
        {parentElement === 'form' ? (
          <form method="dialog" {...parentProps}>
            {children}
          </form>
        ) : (
          <div {...parentProps}>{children}</div>
        )}
        {closeOnClickOutside && (
          <div className="modal-backdrop">
            <button onClick={() => closeModal(props.id)}>close</button>
          </div>
        )}
      </dialog>
    </BaseModal>
  );
}
