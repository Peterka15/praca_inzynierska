import auth from '@/Model/AuthInstance';

export default {
  name: 'NotLoggedInOnly',
  functional: true,

  props: {
    displayError: Boolean,
  },

  render(h, context) {
    const isLoggedIn = auth?.loggedIn;

    if (!isLoggedIn) {
      return context.children;
    }

    return context.props.displayError
      ? <b-alert variant="danger" show class="text-center">Tylko niezalogowany.</b-alert>
      : null;
  }
};
