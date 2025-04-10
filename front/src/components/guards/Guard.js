import auth from '@/Model/AuthInstance';

export default {
  name: 'Guard',
  functional: true,

  props: {
    displayError: Boolean,
    admin: Boolean,
    moderator: Boolean,
    commandant: Boolean,
    user: Boolean,
    public: Boolean,
    loggedIn: Boolean,
    notLoggedIn: Boolean
  },

  render (h, context) {
    const userRole = auth?.user?.role;

    if (context.props.loggedIn && auth?.loggedIn) {
      return context.children;
    }

    if (context.props.notLoggedIn && !auth?.loggedIn) {
      return context.children;
    }

    if (
      userRole && (
        context.props.admin && userRole.isAdmin()
        || context.props.moderator && userRole.isModerator()
        || context.props.commandant && userRole.isCommandant()
        || context.props.user && userRole.isUser()
        || context.props.public && userRole.isPublic()
      )
    ) {
      return context.children;
    }

    return context.props.displayError
      ? <b-alert variant="danger" show class="text-center">Brak dostępu</b-alert>
      : null;
  }
};
