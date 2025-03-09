/* eslint-disable @typescript-eslint/no-explicit-any */
import { IOption } from '@/interfaces';
import { closeModal, openModal } from '@/utils';
import { router, usePage } from '@inertiajs/react';
import { addCommas, digitsEnToFa } from '@persian-tools/persian-tools';
import { produce } from 'immer';
import get from 'lodash/get';
import omit from 'lodash/omit';
import set from 'lodash/set';
import { useState } from 'react';
import { HiOutlineXMark } from 'react-icons/hi2';
import { IconType } from 'react-icons/lib';
import { BaseSearch } from '../Search';
import Button from '../forms/Button';
import DialogModal from './Modal';

type FilterModalProps = {
  filterId: string;
  title: string;
  options: IOption<string>[];
  ButtonIcon: IconType;
  modalTitle?: string;
};

export default function FilterModal({
  ButtonIcon,
  filterId,
  title,
  options,
  modalTitle,
}: FilterModalProps) {
  const currentRoute = usePage().url.split('?')[0];
  const [search, setSearch] = useState('');
  const filterPath = `filter.${filterId}`;
  const modalId = `filter-${filterId}`;
  const currentParams = route().params as Record<string, any>;

  const selectedOption = new Set(get(currentParams, filterPath));
  const hasAnySelectedOption = selectedOption.size > 0;

  const handleClear = () => {
    const data = produce(currentParams, (draft) => {
      draft.filter = omit(get(draft, 'filter', {}), [filterId]);
    });
    router.get(currentRoute, data, { preserveScroll: true, preserveState: true });
  };

  return (
    <>
      <div className="indicator">
        {hasAnySelectedOption && (
          <span className="badge indicator-item badge-neutral">
            {digitsEnToFa(addCommas(selectedOption.size))}
          </span>
        )}
        <Button onClick={() => openModal(modalId)} className="btn btn-sm">
          <span>{title}</span>
          <ButtonIcon className="size-5" />
        </Button>
      </div>
      <DialogModal dialogClassName="modal-bottom md:modal-middle" closeOnClickOutside id={modalId}>
        <div className="flex items-center justify-between">
          <h3 className="h3">{modalTitle ?? title}</h3>
          <Button onClick={() => closeModal(modalId)} className="btn btn-circle btn-sm">
            <HiOutlineXMark className="size-6" />
          </Button>
        </div>
        {hasAnySelectedOption && (
          <div className="flex items-center justify-between">
            <p>{selectedOption.size} گزینه انتخاب شده است.</p>
            <Button onClick={handleClear} className="btn btn-outline btn-error btn-sm">
              حذف همه انتخاب ها
            </Button>
          </div>
        )}
        <BaseSearch search={search} setSearch={setSearch} />
        <div className="space-y-2">
          {options
            .filter((option) => option.label.toLowerCase().includes(search.toLowerCase()))
            .map((option) => (
              <div key={option.value} className="form-control">
                <label className="label cursor-pointer">
                  <span className="label-text">{option.label}</span>
                  <input
                    key={`${option.value}-${selectedOption.has(option.value)}`}
                    defaultChecked={selectedOption.has(option.value)}
                    onChange={(e) => {
                      const filterSet = new Set(get(currentParams, `filter.${filterId}`));
                      if (e.target.checked) filterSet.add(option.value);
                      else filterSet.delete(option.value);
                      router.get(
                        currentRoute,
                        set(currentParams, `filter.${filterId}`, Array.from(filterSet)),
                        { preserveScroll: true, preserveState: true },
                      );
                    }}
                    type="checkbox"
                    className="checkbox-primary checkbox"
                  />
                </label>
              </div>
            ))}
        </div>
      </DialogModal>
    </>
  );
}
