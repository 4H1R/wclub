type CategoriesBadgeProps = {
  categories: App.Data.Category.CategoryData[];
};

export default function CategoriesBadge({ categories }: CategoriesBadgeProps) {
  return (
    <div className="flex flex-wrap items-center gap-2 gap-y-3">
      {categories.map((category) => (
        <span key={category.id} className="badge badge-md bg-base-200">
          {category.title}
        </span>
      ))}
    </div>
  );
}
