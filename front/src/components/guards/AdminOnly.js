import auth from '@/Model/AuthInstance';

export default {
  name: 'AdminOnly',
  functional: true,
  render(h, context) {
    const isAdmin = auth?.user?.role?.isAdmin?.();
    return isAdmin ? context.children : null;
  }
};
