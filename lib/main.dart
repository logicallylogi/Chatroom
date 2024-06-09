import 'package:fluent_ui/fluent_ui.dart';
import 'package:system_theme/system_theme.dart';
import 'package:fluentui_emoji_icon/fluentui_emoji_icon.dart';
import 'package:appwrite/appwrite.dart';

void main() {
  runApp(const MyApp());
}

class MyApp extends StatelessWidget {
  const MyApp({super.key});

  @override
  Widget build(BuildContext context) {
    return FluentApp(
      title: 'Chatroom',
      theme: FluentThemeData(
        accentColor: SystemTheme.accentColor.accent.toAccentColor(),
      ),
      home: const MyHomePage(title: 'Home'),
    );
  }
}

class MyHomePage extends StatefulWidget {
  const MyHomePage({super.key, required this.title});
  final String title;

  @override
  State<MyHomePage> createState() => _MyHomePageState();
}

class _MyHomePageState extends State<MyHomePage> {
  Client client = Client();
  List<NavigationPaneItem> items = [
    PaneItem(
      icon: const Icon(FluentIcons.home),
      title: const Text('Home'),
      body: const _NavigationBodyItem(),
    ),
    PaneItemSeparator(),
    PaneItem(
      icon: const Icon(FluentIcons.issue_tracking),
      title: const Text('Track orders'),
      infoBadge: const InfoBadge(source: Text('8')),
      body: const _NavigationBodyItem(
        header: 'Badging',
        content: Text(
          'Badging is a non-intrusive and intuitive way to display '
              'notifications or bring focus to an area within an app - '
              'whether that be for notifications, indicating new content, '
              'or showing an alert. An InfoBadge is a small piece of UI '
              'that can be added into an app and customized to display a '
              'number, icon, or a simple dot.',
        ),
      ),
    ),
    PaneItem(
      icon: const Icon(FluentIcons.disable_updates),
      title: const Text('Disabled Item'),
      body: const _NavigationBodyItem(),
      enabled: false,
    ),
    PaneItemExpander(
      icon: const Icon(FluentIcons.account_management),
      title: const Text('Account'),
      body: const _NavigationBodyItem(
        header: 'PaneItemExpander',
        content: Text(
          'Some apps may have a more complex hierarchical structure '
              'that requires more than just a flat list of navigation '
              'items. You may want to use top-level navigation items to '
              'display categories of pages, with children items displaying '
              'specific pages. It is also useful if you have hub-style '
              'pages that only link to other pages. For these kinds of '
              'cases, you should create a hierarchical NavigationView.',
        ),
      ),
      items: [
        PaneItemHeader(header: const Text('Apps')),
        PaneItem(
          icon: const Icon(FluentIcons.mail),
          title: const Text('Mail'),
          body: const _NavigationBodyItem(),
        ),
        PaneItem(
          icon: const Icon(FluentIcons.calendar),
          title: const Text('Calendar'),
          body: const _NavigationBodyItem(),
        ),
      ],
    ),
  ];

  void _connectToCloud() {
    setState(() {
      client
          .setEndpoint('https://localhost/v1') // Your Appwrite Endpoint
          .setProject('5e8cf4f46b5e8') // Your project ID
          .setSelfSigned() // Use only on dev mode with a self-signed SSL cert
          ;
    });
  }

  @override
  Widget build(BuildContext context) {

  int topIndex = 0;
  PaneDisplayMode displayMode = PaneDisplayMode.open;

  return NavigationView(
    appBar: const NavigationAppBar(
      title: Text('NavigationView'),
    ),
    pane: NavigationPane(
      selected: topIndex,
      onChanged: (index) => setState(() => topIndex = index),
      displayMode: displayMode,
      items: items,
      footerItems: [
        PaneItem(
          icon: const Icon(FluentIcons.settings),
          title: const Text('Settings'),
          body: const _NavigationBodyItem(),
        ),
        PaneItemAction(
          icon: const Icon(FluentIcons.add),
          title: const Text('Add New Item'),
          onTap: () {
            // Your Logic to Add New `NavigationPaneItem`
            items.add(
              PaneItem(
                icon: const Icon(FluentIcons.new_folder),
                title: const Text('New Item'),
                body: const Center(
                  child: Text(
                    'This is a newly added Item',
                  ),
                ),
              ),
            );
            setState(() {});
          },
        ),
      ],
    ),
  );
  }
}

class _NavigationBodyItem extends StatelessWidget {
  const _NavigationBodyItem({
    this.header,
    this.content,
  });

  final String? header;
  final Widget? content;

  @override
  Widget build(BuildContext context) {
    return ScaffoldPage.withPadding(
      header: PageHeader(title: Text(header ?? 'This is a header text')),
      content: content ?? const SizedBox.shrink(),
    );
  }
}
