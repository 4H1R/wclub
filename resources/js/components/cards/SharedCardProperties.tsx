import React from 'react';

type SharedCardPropertiesProps = {
  targetGroups: App.Data.TargetGroup.TargetGroupData[];
  categories: App.Data.Category.CategoryData[];
};

export default function SharedCardProperties({
  targetGroups,
  categories,
}: SharedCardPropertiesProps) {
  const lists = [
    { title: 'گروه های هدف', data: targetGroups },
    { title: 'دسته بندی ها', data: categories },
  ].filter(({ data }) => data.length > 0);

  return (
    <>
      {lists.map(({ title, data }) => (
        <div className="space-y-2 py-1" key={title}>
          <p className="text-sm font-medium">{title}</p>
          <div className="flex flex-wrap items-center gap-1">
            {data.map((item) => (
              <span key={item.id} className="badge badge-md bg-base-200">
                {item.title}
              </span>
            ))}
          </div>
        </div>
      ))}
    </>
  );
}
