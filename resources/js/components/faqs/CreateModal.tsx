import Button from '@/shared/forms/Button';
import Form from '@/shared/forms/Form';
import Textarea from '@/shared/forms/Textarea';
import Modal from '@/shared/modals/Modal';
import { closeModal, handleServerMessage } from '@/utils';
import { useForm } from '@inertiajs/react';
import React from 'react';
import { HiOutlineX } from 'react-icons/hi';
import { toast } from 'react-toastify';

type CreateModalProps = {
  modalId: string;
  modelId: number;
};

export default function CreateModal({ modalId, modelId }: CreateModalProps) {
  const form = useForm({ question: '', model_id: modelId });

  const handleCloseModal = () => closeModal(modalId);

  const handleSubmit = () => {
    form.post(route('faqs.store'), {
      preserveUrl: true,
      preserveState: true,
      onError: handleServerMessage,
      onSuccess: () => {
        toast.success('پرسش با موفقیت ایجاد شد بعد از پاسخ کارشناسان سوال شما نمایش داده خواهد شد');
        handleCloseModal();
      },
    });
  };

  return (
    <Modal parentElement="div" id={modalId} dialogClassName="modal-bottom md:modal-middle">
      <div className="flex items-center justify-between">
        <h3 className="h3">ایجاد پرسش</h3>
        <Button onClick={handleCloseModal} className="btn btn-circle btn-sm">
          <HiOutlineX className="size-6" />
        </Button>
      </div>
      <Form styleMode="base" form={form} onSubmit={handleSubmit}>
        <Textarea isRequired label={{ text: 'سؤال' }} name="question" attributes={{ rows: 8 }} />
        <div className="flex items-center gap-4">
          <Button
            isLoading={form.processing}
            disabled={form.processing}
            type="submit"
            className="btn btn-primary btn-sm md:btn-md"
          >
            ایجاد
          </Button>
          <Button onClick={handleCloseModal} className="btn btn-sm md:btn-md">
            انصراف
          </Button>
        </div>
      </Form>
    </Modal>
  );
}
