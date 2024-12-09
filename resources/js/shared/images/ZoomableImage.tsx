import { closeModal, cn, openModal } from '@/utils';
import { useId } from 'react';
import Button from '../forms/Button';
import Modal from '../modals/Modal';
import Image, { ImageProps } from './Image';

export default function ZoomableImage({ className, ...props }: ImageProps) {
  const id = useId();
  const modalId = `image-${id}#zoom`;

  return (
    <>
      <Modal parentElement="div" closeOnClickOutside id={modalId}>
        <Image className="h-auto w-full" sizes="100vw" src={props.src} alt={props.alt} />
        <div className="flex items-center gap-4">
          <Button onClick={() => closeModal(modalId)} className="btn btn-outline">
            بستن
          </Button>
        </div>
      </Modal>
      <Image
        {...props}
        className={cn(className, 'cursor-pointer')}
        onClick={() => openModal(modalId)}
      />
    </>
  );
}
