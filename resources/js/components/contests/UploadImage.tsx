import Button from '@/shared/forms/Button';
import ErrorMessage from '@/shared/forms/ErrorMessage';
import Form from '@/shared/forms/Form';
import Modal from '@/shared/modals/Modal';
import { closeModal, openModal, slugifyId } from '@/utils';
import { useForm } from '@inertiajs/react';
import { useEffect, useState } from 'react';
import { HiOutlineX } from 'react-icons/hi';
import { HiCheckBadge, HiPhoto } from 'react-icons/hi2';
import { toast } from 'react-toastify';

const modalId = 'upload-image-contest-modal';

type UploadImageProps = {
  contest: App.Data.Contest.ContestFullData;
  canInteract: boolean;
};

export default function UploadImage({ contest, canInteract }: UploadImageProps) {
  const uploadForm = useForm<{ image: File | null }>({ image: null });
  const [previewUrl, setPreviewUrl] = useState<string | null>(null);

  const handleUploadImage = () => {
    uploadForm.post(route('contests.upload-image', [slugifyId(contest.id, contest.title)]), {
      onSuccess: () => {
        toast.success('تصویر با موفقیت آپلود شد');
        handleCloseModal();
      },
    });
  };

  const handleCloseModal = () => closeModal(modalId);

  const handleFileChange = (event: React.ChangeEvent<HTMLInputElement>) => {
    const file = event.target.files?.[0] ?? null;
    uploadForm.setData('image', file);

    setPreviewUrl((previous) => {
      if (previous) {
        URL.revokeObjectURL(previous);
      }

      return file ? URL.createObjectURL(file) : null;
    });
  };

  useEffect(() => {
    return () => {
      if (previewUrl) {
        URL.revokeObjectURL(previewUrl);
      }
    };
  }, [previewUrl]);

  return (
    <>
      {canInteract && contest.can_upload_image && !contest.has_uploaded_image && (
        <Button onClick={() => openModal(modalId)} className="btn btn-neutral btn-block">
          آپلود تصویر
        </Button>
      )}
      {contest.has_uploaded_image && (
        <div className="flex items-center gap-2">
          <HiCheckBadge className="size-6 text-primary" />
          <p className="text-base-content/80">شما تصویری آپلود کرده اید.</p>
        </div>
      )}
      <Modal parentElement="div" id={modalId} dialogClassName="modal-bottom md:modal-middle">
        <div className="flex items-center justify-between">
          <h3 className="h3">آپلود تصویر</h3>
          <Button onClick={handleCloseModal} className="btn btn-circle btn-sm">
            <HiOutlineX className="size-6" />
          </Button>
        </div>
        <Form styleMode="base" form={uploadForm} onSubmit={handleUploadImage}>
          <p className="text-sm text-base-content/70">
            لطفا تصویری با حجم کمتر از 1 مگابایت انتخاب کنید.
          </p>
          <label className="flex w-full cursor-pointer flex-col items-center justify-center gap-2 rounded-md border border-primary p-4">
            <input type="file" className="hidden" accept="image/*" onChange={handleFileChange} />
            <HiPhoto className="size-6 text-primary" />
            <span className="w-full text-center text-sm font-medium">انتخاب تصویر</span>
          </label>
          {previewUrl && (
            <div className="flex w-full flex-col items-center gap-2">
              <span className="text-sm text-base-content/70">پیش نمایش تصویر</span>
              <img
                src={previewUrl}
                alt="پیش نمایش تصویر مسابقه"
                className="w-full rounded-md object-cover"
              />
            </div>
          )}
          <ErrorMessage name="image" />
          <div className="flex items-center gap-4">
            <Button
              isLoading={uploadForm.processing}
              disabled={uploadForm.processing}
              type="submit"
              className="btn btn-primary btn-sm md:btn-md"
            >
              آپلود
            </Button>
            <Button onClick={handleCloseModal} className="btn btn-sm md:btn-md">
              انصراف
            </Button>
          </div>
        </Form>
      </Modal>
    </>
  );
}
