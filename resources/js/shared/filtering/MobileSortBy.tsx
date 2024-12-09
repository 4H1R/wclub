import { IOption } from '@/interfaces';
import { closeModal, cn, openModal } from '@/utils';
import { router } from '@inertiajs/react';
import get from 'lodash/get';
import { GoSortDesc } from 'react-icons/go';
import { HiOutlineX } from 'react-icons/hi';
import Button from '../forms/Button';
import Modal from '../modals/Modal';

type MobileSortBy = {
  options: IOption<string>[];
};

const modalId = 'mobileSortModal';

export default function MobileSortBy({ options }: MobileSortBy) {
  const currentSort = get(route().params, 'sort', options.at(0)?.value);
  const currentOption = options.find((option) => option.value === currentSort);

  const handleSort = (sort: IOption<string>) => {
    closeModal(modalId);
    router.get(route(route().current() as string, { page: 1, sort: sort.value }), undefined, {
      preserveState: true,
    });
  };

  return (
    <>
      <Button onClick={() => openModal(modalId)} className="btn btn-sm lg:hidden">
        <span>{currentOption?.label}</span>
        <GoSortDesc className="size-6" />
      </Button>
      <Modal id={modalId} dialogClassName="modal-bottom" closeOnClickOutside>
        <div className="flex items-center justify-between">
          <h3 className="h3">مرتب سازی بر اساس</h3>
          <Button onClick={() => closeModal(modalId)} className="btn btn-circle btn-sm">
            <HiOutlineX className="size-6" />
          </Button>
        </div>
        <ul className="space-y-4 divide-y">
          {options.map((sort) => (
            <li key={sort.label}>
              <Button
                onClick={() => handleSort(sort)}
                className={cn('w-full pt-4 text-right font-medium', {
                  'text-secondary': currentSort === sort.value,
                })}
              >
                {sort.label}
              </Button>
            </li>
          ))}
        </ul>
      </Modal>
    </>
  );
}
