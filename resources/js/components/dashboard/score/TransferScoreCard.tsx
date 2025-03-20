import Button from '@/shared/forms/Button';
import Form from '@/shared/forms/Form';
import { InputLists } from '@/shared/forms/Input';
import Modal from '@/shared/modals/Modal';
import { closeModal, handleServerMessage, openModal } from '@/utils';
import { useForm, usePage } from '@inertiajs/react';
import { addCommas, digitsEnToFa } from '@persian-tools/persian-tools';
import React from 'react';
import { HiOutlineX } from 'react-icons/hi';
import { toast } from 'react-toastify';

const modalId = 'score#transfer-to-my-isfahan';

export default function TransferScoreCard() {
  const { auth } = usePage().props;
  const form = useForm({ amount: auth.user!.score });

  const handleOpenModal = () => openModal(modalId);
  const handleCloseModal = () => closeModal(modalId);

  const handleSubmit = () => {
    form.post(route('me.score.transfer-to-my-isfahan'), {
      preserveUrl: true,
      preserveState: true,
      onError: handleServerMessage,
      onSuccess: () => {
        toast.success('امتیاز ها با موفقیت انتقال داده شد');
        handleCloseModal();
      },
    });
  };

  return (
    <>
      <Modal id={modalId} parentElement="div" closeOnClickOutside>
        <div className="flex items-center justify-between">
          <h3 className="h3">انتقال امتیاز به اصفهان من</h3>
          <Button onClick={() => closeModal(modalId)} className="btn btn-circle btn-sm">
            <HiOutlineX className="size-6" />
          </Button>
        </div>
        <Form onSubmit={handleSubmit} form={form} styleMode="base">
          <InputLists
            fields={[
              {
                isRequired: true,
                label: { text: 'مقدار امتیاز' },
                name: 'amount',
                attributes: { type: 'number', min: 1, max: auth.user!.score },
              },
            ]}
          />
          <div className="flex items-center gap-4">
            <Button
              isLoading={form.processing}
              disabled={form.processing}
              type="submit"
              className="btn btn-primary btn-sm md:btn-md"
            >
              انتقال
            </Button>
            <Button onClick={handleCloseModal} className="btn btn-sm md:btn-md">
              انصراف
            </Button>
          </div>
        </Form>
      </Modal>
      <div className="card card-bordered card-compact bg-base-100">
        <div className="card-body">
          <h2 className="card-title">انتقال امتیازات به اصفهان من</h2>
          <p className="text-base-content/80">
            شما میتوانید{' '}
            <span className="font-bold underline">{digitsEnToFa(addCommas(auth.user!.score))}</span>{' '}
            امتیاز خود را به حساب کاربری اصفهان من انتقال دهید و امتیازات خود را در آنجا استفاده
            کنید!
          </p>
          <div className="card-actions justify-end">
            <Button onClick={handleOpenModal} disabled={!auth.user?.score} className="btn btn-sm">
              انتقال امتیازات
            </Button>
          </div>
        </div>
      </div>
    </>
  );
}
