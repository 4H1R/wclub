import Button from '@/shared/forms/Button';
import { GoDotFill } from 'react-icons/go';

type TagsCardProps = {
  categories: App.Data.Category.CategoryData[];
};

export default function CategoriesCard({ categories }: TagsCardProps) {
  if (categories.length <= 0) return null;

  return (
    <div className="card card-compact bg-base-200 md:card-normal">
      <div className="card-body text-center">
        <div className="flex items-center justify-center gap-2 md:justify-start">
          <GoDotFill className="hidden size-4 md:block" />
          <h3 className="h3 text-base-content md:text-start">دسته بندی ها</h3>
        </div>
        <div className="flex flex-wrap items-center gap-2">
          {categories.map((category) => (
            <Button key={category.id} className="btn btn-sm bg-base-300">
              {category.title}
            </Button>
          ))}
        </div>
      </div>
    </div>
  );
}
